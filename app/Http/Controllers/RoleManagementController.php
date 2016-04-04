<?php

namespace App\Http\Controllers;

use App\User;
use App\UserRoles;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleManagementController extends Controller
{

    public function getRoles()
    {
        $user = User::paginate(PAGINATE_LIMIT);

        return view('assign.role',compact('user'));
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
