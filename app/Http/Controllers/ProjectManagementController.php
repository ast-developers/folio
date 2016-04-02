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
			$projects = Project::with('assignProjects')->whereBetween('start_date', [session('from_date'), session('to_date')])->paginate(PAGINATE_LIMIT);
		} else {
			$projects = Project::with('assignProjects')->paginate(PAGINATE_LIMIT);
		}

		return view('assign.project', compact('projects'));
	}

	public function getUsers(Request $request)
	{
		$users = User::where('role', $request['role'])->get()->toArray();
		return json_encode($users);
	}

	public function assignProjectToUser(Request $request)
	{
		$user = User::find($request['user_id']);
		$user->projects()->attach([$request['project_id']]);
	}

	public function getUserProjects(Request $request)
	{
		$user = User::find($request['user_id']);
		$user_projects = $user->projects()->select('user_id')->where('project_id',$request['project_id'])->get()->toArray();
		return json_encode(count($user_projects));
	}

}
