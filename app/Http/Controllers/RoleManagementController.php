<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\User;
use App\UserRoles;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleManagementController extends Controller
{

    public  $users;
    public function __construct(UserRepositoryInterface $users)
    {
        $this->users=$users;
    }
    public function getRoles()
    {
        $users = $this->users->getUsers();

        return view('assign.role',compact('users'));
    }

    public function updateRole(Request $request)
    {
        $user = User::findOrFail($request['user_id']);
        if ($request['role'] == UserRoles::MANAGER)
            $user->role_id = 2;
        else {
            $user->role_id = 3;
        }
        $user->save();
    }
}
