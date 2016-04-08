<?php
/**
 * Created by PhpStorm.
 * User: shabbir
 * Date: 12/5/15
 * Time: 8:44 PM
 */
namespace App;

use DB;
use Illuminate\Support\Facades\Auth;

class RevenueVsCost
{

	public function get($filters, $grouping)
	{

		$query   = DB::query()
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
			"p.start_date as project_start_date",
			"p.end_date as project_end_date",
			"c.month_logged"
		];
		$query->join('projects as p', 'p.id', '=', 'c.project_id');
		$query->select($columns)
			->groupBy('c.project_id')
			->groupBy('p.name')
			->groupBy('c.month_logged');
		$query   = DB::table(DB::raw("({$query->toSql()}) as sub"));
		$groups  = [];
		$columns = [
			DB::raw('SUM(revenue) as revenue'),
			DB::raw('SUM(cost) as cost'),

		];

		foreach ($grouping as $group) {
			$columns[] = $group;
			$groups[]  = $group;
		}

		$query->select($columns);//->where('sub.project_end_date','<=','2015-01-01');

		foreach ($groups as $group) {
			$query->groupBy($group);
			$query->orderBy($group);
		}

		foreach ($filters as $column => $value) {
			$query->where($column, '=', $value);
		}
		if (session('from_date') != NULL) {
			$from = explode('-', session('from_date'));
			$from = $from[0] . $from[1];

			$to = explode('-', session('to_date'));
			$to = $to[0] . $to[1];

			$query->whereBetween('sub.month_logged', [$from, $to]);
		}
		if(Auth::user()->role_id == THREE || Auth::user()->role_id == TWO)
		{
			$user = Auth::user();
			$user_projects = $user->projects()->select('user_id')->get();
			$project_id       = array();
			$i                = 0;
			foreach ($user_projects as $item) {
				$project_id[$i] = $item->pivot->project_id;
				$i++;
			}

			$query->whereIn('sub.project_id',$project_id);
		}
		return collect($query->get());
	}
}