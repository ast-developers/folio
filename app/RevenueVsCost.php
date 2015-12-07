<?php
/**
 * Created by PhpStorm.
 * User: shabbir
 * Date: 12/5/15
 * Time: 8:44 PM
 */
namespace App;
use DB;

class RevenueVsCost
{

    public function get($filters, $grouping) {
        $query = DB::query()
            ->from('project_costs as c');
        $columns = [
            DB::raw('SUM(c.project_cost + COALESCE(c.shared_cost, 0)) as cost'),
            DB::raw('
                (SELECT
                    sum(r.amount)
                FROM
                    revenue r
                WHERE
                    r.project_id = c.project_id
                AND MONTH(r.received_on)+ YEAR(r.received_on)* 100 = c.month_logged
                ) as revenue
            '),
            "c.project_id",
            "p.name as project_name",
            "c.month_logged"
        ];
        $query->join('projects as p', 'p.id', '=', 'c.project_id');
        $query->select($columns)
            ->groupBy('c.project_id')
            ->groupBy('p.name')
            ->groupBy('c.month_logged');

        $query = DB::table( DB::raw("({$query->toSql()}) as sub") );
        $groups = [];
        $columns = [
            DB::raw('SUM(revenue) as revenue'),
            DB::raw('SUM(cost) as cost')];
        foreach($grouping as $group) {
            $columns[] = $group;
            $groups[] = $group;
        }

        $query->select($columns);
        foreach($groups as $group) {
            $query->groupBy($group);
            $query->orderBy($group);
        }
        foreach($filters as $column=>$value) {
            $query->where($column, '=', $value);
        }

        return collect($query->get());
    }
}