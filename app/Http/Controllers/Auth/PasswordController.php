<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordSetRequest;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class PasswordController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/
	public function getResetPassword($email)
	{
		return view('password.reset',compact('email'));
	}
	public function setPassword(PasswordResetRequest $request)
	{
		$credentials = $request->only(
			'email', 'password', 'password_confirmation'
		);
		$user        = User::where('email', $credentials['email'])->first();
		if ($user) {
			$user->password = $credentials['password_confirmation'];
			$user->save();
			return redirect('/');
		} else {
			Session::flash('message', 'Your Email-Id does not exists');
			return Redirect::back();
		}
	}
}
