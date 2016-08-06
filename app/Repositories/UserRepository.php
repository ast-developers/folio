<?php
/**
 * Created by PhpStorm.
 * User: rashmi-dholakiya
 * Date: 4/4/16
 * Time: 11:03 AM
 */
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\User;
use App\UserRoles;

class UserRepository implements UserRepositoryInterface
{
	public function getUsers()
	{
		$users =  User::with('userRole')->whereHas('userRole' , function($q){
			$q->where('user_role_name','!=', UserRoles::ADMIN);
		})->paginate(PAGINATE_LIMIT);

		return $users;
	}

	public function getUsersByRole($role)
	{
		$users =  User::whereHas('userRole' , function($q) use ($role){
			return $q->where('user_role_name',$role);
		})->get()->toArray();

		return $users;
	}

	public function getUserByIdWithRole($id)
	{
		$users = User::with('userRole')->with(['projects' => function ($q) {
			return $q->selectRaw('group_concat(projects.id) as project_ids');
		}])->find($id);
		return $users;
	}

	public function save($request, $id = NULL)
	{
		if ($id) {
			$user = User::find($id);
			$user->projects()->detach();
		} else {
			$user = new User();
		}
		$values = array('name' => $request['name'], 'email' => $request['email'],'remember_token'=>$request['_token'] ,'role_id' => $request['role']);
		$user->fill($values);
		$user->save();
		foreach ($request['project_ids'] as $project_id) {
			$user->projects()->attach($project_id);
		}
		return $user;
	}

	public function updateProfile($request)
	{
		$user = User::find($request['user_id']);
		$values = array('name' => $request['name'], 'email' => $request['email'],'password' => (isset($request['password']))?$request['password']:$user->password);
		$user->fill($values);
		$user->save();
	}
}
