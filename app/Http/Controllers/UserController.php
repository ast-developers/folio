<?php
namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\updateUserRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Staff;
use App\User;
use App\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Socialite;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class UserController extends Controller
{
    protected $userRepository;
    protected $projectRepository;

    public function __construct(UserRepositoryInterface $usersRepository, ProjectRepositoryInterface $projectRepository)
    {
        $this->userRepository = $usersRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getUsers();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_roles = UserRoles::lists('user_role_name', 'id')->toArray();
        $projects = $this->projectRepository->getAllProjects()->lists('name', 'id');
        return view('user.create', compact('user_roles', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->userRepository->save($request->all());
        Event::fire(new SendMail($user));
        Session::flash('message', 'User successfully added!');
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $selected_project_list = null;
        $user = $this->userRepository->getUserByIdWithRole($id);
        $projects = $this->projectRepository->getAllProjects()->lists('name', 'id');
        $selected_project_list = $this->projectRepository->getSelectedProjectList($user);
        return view('user.edit', compact('user', 'projects', 'selected_project_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->userRepository->save($request->all(), $id);
        Session::flash('message', 'User successfully updated!');
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->projects()->detach($id);
        if (User::destroy($id)) {
            Session::flash('message', 'User successfully updated!');
            return Redirect::back();
        } else {
            return redirect('user');
        }
    }

    public function setPassword($email, $token)
    {
        $user = User::where('remember_token', $token)->where('email', $email)->first();
        if ($user) {
            return view('errors.unauthorized');
        }
        return view('password.reset', compact('email', 'token'));
    }

    public function googlehandle()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('auth/google');
        }
        $authUser = $this->findOrCreateUser($user);
        if (!$authUser) {
            Session::flash('message', 'You are not a member of Arsenal Team. or You are not authorized uder. So you can not login');
            return Redirect::to('/auth/login');
        }
        Auth::login($authUser, true);
        return Redirect::to('/');
    }

    private function findOrCreateUser($google_user)
    {
        $user = User::where('email', $google_user->email)->firstOrFail();
        if (!$user) {
            $user->name = $google_user->name;
            $user->email = $google_user->email;
            $user->google_id = $google_user->id;
            $user->avatar = $google_user->avatar;
            $user->access_token = $google_user->token;
            $user->save();
        }
        return $user;
        /* else{
            return false;
        }*/
    }
}
