<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use JiraRestApi\Configuration\ConfigurationInterface;
use JiraRestApi\Issue\IssueService;
use JiraRestApi\Issue\Worklog;
use JiraRestApi\JiraException;
use JiraRestApi\Project\ProjectService;

class Project extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'jira_key', 'start_date', 'end_date', 'is_overhead'];

    public function revenues()
    {
        return $this->hasMany(Revenue::class);
    }

    public function timelog() {
        return $this->hasMany(Timelog::class);
    }

    public function costs() {
        return $this->hasMany(ProjectCost::class)->orderBy('month_logged')->orderBy('staff_id');
    }
    
    public function syncWithJira() {
        $staff_list = Staff::all();
        Timelog::where('project_id', '=', $this->id)->delete();
        $issue_service = new IssueService(app(ConfigurationInterface::class));
        $start = 0;

        while(1) {
            $issues = $issue_service->search(
                "project={$this->jira_key} and timespent>0 and updated >= {$this->start_date}",
                $start,
                250,
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
                        'project_id' => $this->id,
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
    }

}
