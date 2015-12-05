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
            t.project_id,
            t.staff_id,
            sum(t.time_spent / 60 / 60) as hours,
            sum(
                t.time_spent / 60 / 60 *(
                    SELECT
                        rate
                    FROM
                        staff_rates sr
                    WHERE
                        sr.staff_id = t.staff_id
                    AND t.started > sr.effective_date
                    ORDER BY
                        sr.effective_date DESC
                    LIMIT 1
                )
            ) as amount
        FROM
            timelog t
        GROUP BY
            t.project_id,
            t.staff_id
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
