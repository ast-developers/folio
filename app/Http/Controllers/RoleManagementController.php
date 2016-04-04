<?php

namespace App\Http\Controllers;

use App\User;
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
        $user->role = $request['role'];
        $user->save();
    }
}
