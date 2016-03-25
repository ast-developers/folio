<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
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
		return Socialite::driver('google')->redirect();
	}

	public function googlehandleProviderCallback()
	{

		try {
			$user = Socialite::driver('google')->user();

		} catch (Exception $e) {
			return redirect('auth/google');
		}

		$authUser = $this->findOrCreateUser($user);

		Auth::login($authUser, true);

		return Redirect::to('/');
	}

	private function findOrCreateUser($googleUser)
	{

		$authUser = User::where('google_id', $googleUser->id)->first();

		if ($authUser) {
			return $authUser;
		}

		return User::create([
			'name'         => $googleUser->name,
			'email'        => $googleUser->email,
			'google_id'    => $googleUser->id,
			'avatar'       => $googleUser->avatar,
			'access_token' => $googleUser->token,

		]);
	}

}
