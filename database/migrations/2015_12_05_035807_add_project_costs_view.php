<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProjectCostsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
        CREATE VIEW project_costs AS SELECT
            `t`.`project_id` AS `project_id`,
            `t`.`staff_id` AS `staff_id`,
            sum(((`t`.`time_spent` / 60) / 60))AS `hours`,
            sum(
                (
                    ((`t`.`time_spent` / 60) / 60)*(
                        SELECT
                            `sr`.`rate`
                        FROM
                            `staff_rates` `sr`
                        WHERE
                            (
                                (`sr`.`staff_id` = `t`.`staff_id`)
                                AND(
                                    `t`.`started` > `sr`.`effective_date`
                                )
                            )
                        ORDER BY
                            `sr`.`effective_date` DESC
                        LIMIT 1
                    )
                )
            )AS `project_cost`,
            (
                SELECT
                    sum(amount)
                FROM
                    shared_costs
                WHERE
                    MONTH(incurred_on)= MONTH(t.started)
            )/(
                SELECT
                    sum(t_inner.time_spent /(60 * 60))
                FROM
                    timelog t_inner
                WHERE
                    MONTH(t.started)= MONTH(t_inner.started)
            )* sum(((`t`.`time_spent` / 60) / 60))AS shared_cost,
            MONTH(t.started)+ YEAR(t.started)* 100 AS month_logged
        FROM
            `timelog` `t`
        GROUP BY
            `t`.`project_id`,
            `t`.`staff_id`,
            MONTH(t.started),
            YEAR(t.started)
            ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW project_costs');
    }
}
