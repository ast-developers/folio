<?php
/**
 * Created by PhpStorm.
 * User: rashmi-dholakiya
 * Date: 4/4/16
 * Time: 11:03 AM
 */
namespace App\Repositories;
use App\Interfaces\ProjectRepositoryInterface;
use App\Project;
use Illuminate\Support\Facades\Auth;


class ProjectRepository implements ProjectRepositoryInterface
{
	public function getAssignedProjects()
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

	public function getProjects()
	{
		if (session('projects') != NULL) {
			$projects = session('projects');
		} else {
			if (session('from_date') != NULL) {
				$projects = Project::whereBetween('start_date', [session('from_date'), session('to_date')])->paginate(PAGINATE_LIMIT);
			} else {
				$projects = Project::paginate(PAGINATE_LIMIT);
			}
		}
		return $projects;
	}
}
