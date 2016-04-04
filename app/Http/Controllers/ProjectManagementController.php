<?php

namespace App\Http\Controllers;

use App\AssignProject;
use App\Project;
use App\User;
use App\UserRoles;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectManagementController extends Controller
{
	public function getProject()
	{
		if (session('from_date') != NULL) {
			$projects = Project::whereBetween('start_date', [session('from_date'), session('to_date')])->paginate(PAGINATE_LIMIT);
		} else {
			$projects = Project::paginate(PAGINATE_LIMIT);
		}

		return view('assign.project', compact('projects'));
	}

	public function getUsers(Request $request)
	{
		$role = $request['role'];
		$users = User::wherehas('userRole',function($q) use($role){
               return $q->where('user_role_name',$role);
			})->get()->toArray();
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
		$user_projects = $user->projects()->select('user_id')->where('project_id',$request['project_id'])->get()->count('user_id');
		return json_encode($user_projects);
	}

}
