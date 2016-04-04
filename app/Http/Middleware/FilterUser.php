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
			case 1:
				return redirect('report');
				break;
			case 2:
				$projects = $this->projects->getProjects();
				session(['projects' => $projects]);
				break;
			case 3:
				$projects = $this->projects->getProjects();
				session(['projects' => $projects]);
				break;
			case 4:
				return redirect('welcome');
				break;

			default:
				return redirect('error');
		}
		return $next($request);
	}
}
