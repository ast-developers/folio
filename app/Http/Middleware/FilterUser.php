<?php

namespace App\Http\Middleware;

use App\AssignProject;
use App\Interfaces\ProjectRepositoryInterface;
use Closure;
use Illuminate\Support\Facades\Auth;

class FilterUser
{
	public  $projects;
	public function __construct(ProjectRepositoryInterface $project)
	{
		$this->projects=$project;
	}
	/**
	 * Handle an incoming request.
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		switch(Auth::user()->role_id)
		{
			case FIVE:
				return redirect('report');
				break;
			case TWO:
			case THREE:
				$projects = $this->projects->getAssignedProjects();
				session(['projects' => $projects]);
				break;
			case FOUR:
				return redirect('welcome');
				break;

			default:
				return redirect('error');
		}
		return $next($request);
	}
}
