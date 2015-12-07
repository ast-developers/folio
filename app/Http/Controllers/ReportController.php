<?php
/**
 * Created by PhpStorm.
 * User: shabbir
 * Date: 12/6/15
 * Time: 7:06 PM
 */
namespace App\Http\Controllers;

use App\RevenueVsCost;

class ReportController extends Controller
{
    public function project(RevenueVsCost $revenue_vs_cost) {

        $performance = $revenue_vs_cost->get([], ['month_logged', 'project_name']);
        return view('reports.project', compact('performance'));
    }

    public function monthly(RevenueVsCost $revenue_vs_cost) {

        $performance = $revenue_vs_cost->get([], ['month_logged']);
        return view('reports.monthly', compact('performance'));
    }

    public function timesheet() {

    }
}