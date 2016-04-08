<?php

namespace App\Http\Controllers;

use App\AssignProject;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Project;
use App\User;
use App\UserRoles;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectManagementController extends Controller
{
	public  $users;
	public  $projects;
	public function __construct(UserRepositoryInterface $users,ProjectRepositoryInterface $projects)
	{
		$this->users=$users;
		$this->projects=$projects;
	}
	public function getProject()
	{
		$projects = $this->projects->getProjects();

		return view('assign.project', compact('projects'));
	}

	public function getUsers(Request $request)
	{
		$role = $request['role'];
		$users = $this->users->getUsersByRole($role);
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
