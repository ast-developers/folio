<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Project;
use App\Revenue;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;

class RevenueController extends Controller
{

    public  $project_repository;
    public  $user_repository;

    public function __construct(ProjectRepositoryInterface $project_repository,UserRepositoryInterface $user_repository)
    {
        $this->project_repository=$project_repository;
        $this->user_repository=$user_repository;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $project_id = \Input::get("project_id");
        $project = $this->project_repository->getProjectByRole($project_id);
        return (isset($project)) ? view('revenue.create', compact('project')) : view('errors.503');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Revenue::create($request->all());

        Session::flash('message', 'Revenue successfully added!');

        return redirect(route('project.show', $request->get('project_id')));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $selected_project_list = $this->project_repository->getSelectedProjectList($this->user_repository->getUserByIdWithRole(Auth::id()));
        $revenue = Revenue::whereIn('project_id',$selected_project_list)->find($id);
        return (isset($revenue)) ? view('revenue.edit', compact('revenue')) : view('errors.503');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        $revenue = Revenue::findOrFail($id);
        $revenue->update($request->all());

        Session::flash('message', 'Revenue successfully updated!');

        return redirect(route('project.show', $request->get('project_id')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $revenue = Revenue::find($id);
        Revenue::destroy($id);

        Session::flash('message', 'Revenue successfully deleted!');

        return redirect(route('project.show', $revenue->project_id));
    }

}
