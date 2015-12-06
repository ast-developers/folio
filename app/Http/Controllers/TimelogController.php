<?php
/**
 * Created by PhpStorm.
 * User: shabbir
 * Date: 12/6/15
 * Time: 6:01 PM
 */
namespace App\Http\Controllers;
use App\Project;
use App\Staff;
use App\Timelog;
use JiraRestApi\Configuration\ConfigurationInterface;
use JiraRestApi\Issue\IssueService;
use Request;

class TimelogController extends Controller
{
    public function create(\Request $request) {
        $data = Request::json()->all();
        $issue_service = new IssueService(app(ConfigurationInterface::class));
        $url_parts = parse_url($data['worklog']['self']);
        $uri   = $url_parts['path'];
        $regex = '~^/rest/api/./issue/(?P<issue_id>.*?)/(?P<ignore>.*?)/?$~';

        $matched = preg_match($regex, $uri, $matches);
        if(!$matched) {
            return null;
        }
        $issue = $issue_service->get($matches['issue_id']);
        $project_key = $issue->fields->project->key;
        $project = Project::whereJiraKey($project_key)->first();
        $employee = Staff::whereUserName($data['worklog']['author']['name'])->first();
        //return $project;
        $time_spent = $data['worklog']['timeSpentSeconds'];
        $started = $data['worklog']['started'];
        $timelog_jira_id = $data['worklog']['id'];
        $timelog = Timelog::whereJiraId($timelog_jira_id)->first();
        if($timelog == null) {
            $timelog = new Timelog();
        }
        $timelog->project_id = $project->id;
        $timelog->staff_id = $employee->id;
        $timelog->started = $started;
        $timelog->time_spent = $time_spent;
        $timelog->jira_id = $timelog_jira_id;
        $timelog->save();
        //debugInfo($timelog);
        return $timelog;
    }
}