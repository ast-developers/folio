<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Requests\Request;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Project;
use App\RevenueVsCost;
use App\User;
use App\UserRoles;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Session;
use Response;
use Log;

class ProjectController extends Controller
{
    public $project_repository;
    public $user_repository;

    public function __construct(ProjectRepositoryInterface $project_repository, UserRepositoryInterface $user_repository)
    {
        $this->project_repository = $project_repository;
        $this->user_repository = $user_repository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $projects = $this->project_repository->getFilteredProjects();
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->all());
        $projects = $this->project_repository->getAssignedProjects();
        if (Auth::user()->role_id != ONE) {
            Auth::user()->projects()->attach($project->id);
            session(['projects' => $projects]);
        }
        if ($project->syncWithJira()) {
            Session::flash('message', 'Project successfully added!');
            return redirect('project');
        } else {
            Session::flash('message', 'Your Jira key is invalid');
            Project::destroy($project->id);
            return Redirect::back();
        }
    }

    /**
     * Display the specified resource.
     * @param  int          $id
     * @param RevenueVsCost $revenue_vs_cost
     * @return Response
     */
    public function show($id, RevenueVsCost $revenue_vs_cost)
    {
        $project = Project::with(['revenues', 'costs', 'costs.staff'])
            ->findOrFail($id);
        $performance = $revenue_vs_cost->get(['project_id' => $id], ['month_logged']);
        return view('project.show', compact('project', 'performance'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $project = $this->project_repository->getProjectByRole($id);
        return (isset($project)) ? view('project.edit', compact('project')) : view('errors.503');
    }

    /**
     * Update the specified resource in storage.
     * @param  int $id
     * @return Response
     */
    public function update($id, ProjectRequest $request)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        if (Auth::user()->role_id != ONE) {
            $projects = $this->project_repository->getAssignedProjects();
            session(['projects' => $projects]);
        }
        Session::flash('message', 'Project successfully updated!');
        return redirect('project');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role_id == THREE) {
            return view('errors.503');
        }
        Project::destroy($id);
        if (Auth::user()->role_id != ONE) {
            Auth::user()->projects()->detach($id);
            $projects = $this->project_repository->getAssignedProjects();
            session(['projects' => $projects]);
        }
        Session::flash('message', 'Project successfully deleted!');
        return Redirect::back();
    }

    public function syncWithJira($id = null)
    {
        try {
            \DB::beginTransaction();
            if ($id != null) {
                Project::findOrFail($id)->syncWithJira();
            } else {
                foreach (Project::all() as $project) {
                    $project->syncWithJira();
                }
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
        return 'synced succesfully';
    }



    public function createFromJiraHook(\Illuminate\Http\Request $request)
    {
        $data = $request->json()->all();

        // Save the project info.
        $project = new Project();
        $project->name = $data["project"]["name"];
        $project->jira_key = $data["project"]["key"];
        $project->start_date= Carbon::now();
        $project->end_date = Carbon::now()->addYear(1);
        $project->is_overhead = 0;
        $project->save();
    }
}
