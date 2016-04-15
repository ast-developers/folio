<?php
/**
 * Created by PhpStorm.
 * User: shabbir
 * Date: 12/6/15
 * Time: 7:06 PM
 */
namespace App\Http\Controllers;

use App\RevenueVsCost;
use App\UserRoles;
use Illuminate\Support\Facades\App;

class ReportController extends Controller
{
    public function project(RevenueVsCost $revenue_vs_cost) {

        $performance = $revenue_vs_cost->get([], ['project_name']);
        return view('reports.project', compact('performance'));
    }
    
    public function projectMonthly(RevenueVsCost $revenue_vs_cost) {

        $performance = $revenue_vs_cost->get([], ['month_logged', 'project_name']);
        return view('reports.project-monthly', compact('performance'));
    }

    public function monthly(RevenueVsCost $revenue_vs_cost) {

        $performance = $revenue_vs_cost->get([], ['month_logged']);
        return view('reports.monthly', compact('performance'));
    }

    public function timesheet() {

    }

    public function generateByPackage()
    {
		$report                          = App::make("getReporticoEngine");
		$report->initial_execute_mode    = UserRoles::REPORTICO_ADMIN;
		$report->access_mode             = FULL_ACCESS;
		$report->initial_project         = "admin";
		$report->clear_reportico_session = true;

        return view('reports.package-reports', compact('report'));
    }
}