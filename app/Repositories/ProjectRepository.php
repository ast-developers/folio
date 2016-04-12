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
		foreach ($user_projects as $key=>$item) {
			$project_id[$key] = $item->pivot->project_id;
		}
		$projects = $this->getProject($project_id);

		return $projects;
	}

	public function getFilteredProjects()
	{
		if (session('projects') != NULL) {
			return  session('projects');
		} else {
			return $this->getProject();
		}
	}

	public function getAllProjects()
	{
		return  Project::all();
	}

	public function getProject($project_id = NULL){
		$projects = Project::where(function($q) use($project_id){
			$query = NULL;
			if (session('from_date') != NULL) {
				$query =  $q->whereBetween('start_date', [session('from_date'), session('to_date')]);
			}
			if($project_id != NULL){
				$query = $q->whereIn('id', $project_id);
			}
			if($query) { return $query; }
		})->paginate(PAGINATE_LIMIT);

		return $projects;
	}
}
