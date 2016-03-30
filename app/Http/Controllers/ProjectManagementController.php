<?php

namespace App\Http\Controllers;

use App\AssignProject;
use App\Project;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectManagementController extends Controller
{
    public function getProject()
    {
        if (session('from_date') != NULL) {
            $projects = Project::with('assign_projects')->whereBetween('start_date', [session('from_date'), session('to_date')])->paginate(PAGINATE_LIMIT);
        } else {
            $projects = Project::with('assign_projects')->paginate(PAGINATE_LIMIT);
        }

        return view('assign.project', compact('projects'));
    }

    public function assign(Request $request)
    {
        $assign_projects = new AssignProject();
        $assign_projects->project_id = $request['project_id'];
        $assign_projects->assigned_to = $request['role'];
        $assign_projects->save();

    }

}
