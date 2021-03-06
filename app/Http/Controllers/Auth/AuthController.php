<?php

namespace App\Http\Controllers\Auth;

use App\Staff;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Socialite;
use Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	protected $redirectPath = '/';

	/**
	 * Create a new authentication controller instance.
	 * @return void
	 */
	public function __construct()
	{
		Session::flush();
		$this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
	 * Get a validator for an incoming registration request.
	 * @param  array $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name'     => 'required|max:255',
			'email'    => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 * @param  array $data
	 * @return User
	 */
	protected function create(array $data)
	{
		return User::create([
			'name'     => $data['name'],
			'email'    => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}

	public function googleredirectToProvider()
	{
		return Socialite::with('google')->redirect();
	}

	public function googlehandleProviderCallback()
	{
		try {
			$user = Socialite::with('google')->user();

		} catch (Exception $e) {
			return redirect('auth/google');
		}

		$authUser = $this->findOrCreateUser($user);

		if(!$authUser)
		{
			Session::flash('message', 'You are not a member of Arsenal Team. or You are not authorized uder. So you can not login');
			return Redirect::to('/auth/login');
		}
		Auth::login($authUser, true);

		return Redirect::to('/');
	}

}
