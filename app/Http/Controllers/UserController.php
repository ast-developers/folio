<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Http\Requests\UserRequest;
use App\Staff;
use App\User;
use App\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


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
		$user_roles = UserRoles::where('user_role_name', '!=', UserRoles::ADMIN)->lists('user_role_name', 'id')->toArray();
		$projects = $this->projectRepository->getAllProjects()->lists('name', 'id');;
		return view('user.create', compact('user_roles', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
		$this->userRepository->save($request->all());
		//Event::fire(new SendMail($user));
		return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$selected_project_list = null;
		$user     = $this->userRepository->getUserByIdWithRole($id);
		$projects = $this->projectRepository->getAllProjects()->lists('name', 'id');
		if (($user->projects->count())) {
			$selected_project_list = explode(',', $user->projects[0]->project_ids);
		}
		return view('user.edit', compact('user', 'projects', 'selected_project_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$this->userRepository->save($request->all(), $id);
		Session::flash('flash_message', 'User successfully updated!');
		return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		User::find($id)->projects()->detach($id);
		if (User::destroy($id)) {
			Session::flash('flash_message', 'User successfully updated!');
			return Redirect::back();
		} else {
			return redirect('user');
		}

    }
}
