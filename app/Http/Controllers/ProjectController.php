<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Interfaces\ProjectRepositoryInterface;
use App\Project;
use App\RevenueVsCost;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Response;

class ProjectController extends Controller
{

	public  $project_repository;
	public function __construct(ProjectRepositoryInterface $project)
	{
		$this->project_repository=$project;
	}
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		$projects = $this->project_repository->getProjects();
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
	public function store(Request $request)
	{

		$project = Project::create($request->all());
		$user = Auth::user();
		$user->projects()->attach($project->id);

		$projects = $this->project_repository->getAssignedProjects();
		session(['projects' => $projects]);

		$project->syncWithJira();

		Session::flash('flash_message', 'Project successfully added!');

		return redirect('project');
	}

	/**
	 * Display the specified resource.
	 * @param  int $id
	 * @param RevenueVsCost $revenue_vs_cost
	 * @return Response
	 */
	public function show($id, RevenueVsCost $revenue_vs_cost)
	{
		$project     = Project::with(['revenues', 'costs', 'costs.staff'])
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
		$project = Project::findOrFail($id);

		return view('project.edit', compact('project'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param  int $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{

		$project = Project::findOrFail($id);
		$project->update($request->all());

		if(Auth::user()->role_id!=1) {
			$projects = $this->project_repository->getAssignedProjects();
			session(['projects' => $projects]);
		}

		Session::flash('flash_message', 'Project successfully updated!');

		return redirect('project');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Project::destroy($id);

		$user = Auth::user();
		$user->projects()->detach($id);
		if($user->role_id!=1) {
			$projects = $this->project_repository->getAssignedProjects();
			session(['projects' => $projects]);
		}
		Session::flash('flash_message', 'Project successfully deleted!');
		return redirect('project');
	}

	public function syncWithJira($id = NULL)
	{
		try {
			\DB::beginTransaction();
			if ($id != NULL) {
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

}
