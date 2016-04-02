<?php

namespace App\Http\Middleware;

use App\AssignProject;
use App\Project;
use Closure;
use Illuminate\Support\Facades\Auth;

class FilterUser
{
	/**
	 * Handle an incoming request.
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (Auth::user()->role == 'Manager') {
			$projects = $this->getProjects();
			session(['projects' => $projects]);
		} elseif (Auth::user()->role == 'Sales') {
			$projects = $this->getProjects();
			session(['projects' => $projects]);
		} elseif (Auth::user()->role == 'Guest') {
			return redirect('welcome');
		} elseif (Auth::user()->role == 'Admin') {
			return redirect('report');
		} else {
			return redirect('error');
		}

		return $next($request);
	}

	public function getProjects()
	{
		$user = Auth::user();
		$user_projects = $user->projects()->select('user_id')->get();
		$project_id       = array();
		$i                = 0;
		foreach ($user_projects as $item) {
			$project_id[$i] = $item->pivot->project_id;
			$i++;
		}
		if (session('from_date') != NULL) {
			$projects = Project::whereIn('id', $project_id)->whereBetween('start_date', [session('from_date'), session('to_date')])->paginate(PAGINATE_LIMIT);
		} else {
			$projects = Project::whereIn('id', $project_id)->paginate(PAGINATE_LIMIT);
		}
		return $projects;
	}
}
