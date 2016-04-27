<?php
/**
 * Created by PhpStorm.
 * User: rashmi-dholakiya
 * Date: 4/4/16
 * Time: 11:03 AM
 */
namespace App\Repositories;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Project;
use App\UserRoles;
use Illuminate\Support\Facades\Auth;


class ProjectRepository implements ProjectRepositoryInterface
{
	protected $user_repository;

	public function __construct()
	{
		$this->user_repository = new UserRepository();
	}
	public function getAssignedProjects()
	{
		$user = Auth::user();
		if ($user->user_id == ONE) {
			$projects = $this->getProject();
		}
		else{
		$user_projects = $user->projects()->select('user_id')->get();
		$project_id       = array();
		foreach ($user_projects as $key=>$item) {
			$project_id[$key] = $item->pivot->project_id;
		}
		$projects = $this->getProject($project_id);
		}
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
		return  Project::orderBy('name');
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

	public function getProjectByRole($id){
		$project = null;
		switch (Auth::user()->role_id)
		{
			case ONE:
				$project = Project::findOrFail($id);
				break;
			case TWO:
				$user                  = $this->user_repository->getUserByIdWithRole(Auth::id());
				$selected_project_list = $this->getSelectedProjectList($user);
				if ($selected_project_list) {
					if (in_array($id, $selected_project_list)) {
						$project = Project::findOrFail($id);
					}
				}
				break;
			case THREE:
				break;
		}

		return $project ;
	}

	public function getSelectedProjectList($user)
	{
		if (($user->projects->count())) {
			return explode(',', $user->projects[0]->project_ids);
		} else {
			return ;
		}

	}
}
