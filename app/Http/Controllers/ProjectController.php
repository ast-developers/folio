<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\RevenueVsCost;
use App\Staff;
use App\Timelog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use JiraRestApi\Configuration\ConfigurationInterface;
use JiraRestApi\Issue\IssueService;
use JiraRestApi\Issue\Worklog;
use JiraRestApi\JiraException;
use JiraRestApi\Project\ProjectService;
use Session;
use Response;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $projects = Project::paginate(15);

        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        
        Project::create($request->all());

        Session::flash('flash_message', 'Project successfully added!');

        return redirect('project');
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @param RevenueVsCost $revenue_vs_cost
     * @return Response
     */
    public function show($id, RevenueVsCost $revenue_vs_cost)
    {
        $project = Project::with(['revenues', 'costs', 'costs.staff'])
            ->findOrFail($id);
        $performance = $revenue_vs_cost->get(['project_id'=>$id], ['month_logged']);
        return view('project.show', compact('project', 'performance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        $project = Project::findOrFail($id);
        $project->update($request->all());

        Session::flash('flash_message', 'Project successfully updated!');

        return redirect('project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Project::destroy($id);

        Session::flash('flash_message', 'Project successfully deleted!');

        return redirect('project');
    }

    public function syncWithJira($id) {
        $project = Project::find($id);
        $staff_list = Staff::all();
        try {
            \DB::beginTransaction();
            Timelog::where('project_id', '=', $id)->delete();
            $issue_service = new IssueService(app(ConfigurationInterface::class));
            $start = 0;

            while(1) {
                $issues = $issue_service->search(
                    "project={$project->jira_key} and timespent>0 and updated >= {$project->start_date}",
                    $start,
                    1000,
                    [
                        "key",
                        "worklog"
                    ]
                );

                if(count($issues->getIssues()) == 0) {
                    break;
                }
                $timelogs = [];
                foreach ($issues->getIssues() as $issue) {
                    $jira_work_logs = $issue->fields->worklog->worklogs;
                    foreach($jira_work_logs as $jira_work_log) {
                        if(!isset($jira_work_log->author)) {
                            continue;
                        }
                        $employee = $staff_list->where('email', $jira_work_log->author->emailAddress)->first();
                        if($employee == null) {
                            continue;
                        }

                        $timelogs[] = [
                            'project_id' => $id,
                            'staff_id' => $employee->id,
                            'time_spent' => $jira_work_log->timeSpentSeconds,
                            'jira_id' => $jira_work_log->id,
                            'started' => $jira_work_log->started
                        ];
                    }

                }

                Timelog::insert($timelogs);
                $start += count($issues->getIssues());
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
        return 'tst';
    }

}
