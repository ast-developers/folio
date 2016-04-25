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
use Illuminate\Support\Facades\Auth;
use App\Reportico\ReporticoExtended;

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
        $user_role                              = Auth::user()->role_id != ONE;
        $report_object                          = App::make("getReporticoEngine");
        $report_object->initial_execute_mode    = ($user_role) ? MENU_ACCESS : UserRoles::REPORTICO_ADMIN;
        $report_object->access_mode             = ($user_role) ? ALLPROJECTS_ACCESS : FULL_ACCESS;
        $report_object->initial_project         = INITIAL_PROJECT;
        $report_object->initial_report          = false;
        $reportico_extended = new ReporticoExtended();
        $reportico_extended->login();
        $report_object->clear_reportico_session = true;

        return view('reports.package-reports', compact('report_object'));
    }

    public function executeByPackage($project_name, $file)
    {
        $report_object                          = App::make("getReporticoEngine");
        $report_object->initial_execute_mode    = PREPARE_MODE ;
        $report_object->access_mode             = ALLPROJECTS_ACCESS;
        $report_object->initial_project         = $project_name;
        $report_object->initial_report          = $file . '.xml';
        $report_object->clear_reportico_session = true;

        return view('reports.package-reports', compact('report_object'));
    }
}