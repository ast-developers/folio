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

}
