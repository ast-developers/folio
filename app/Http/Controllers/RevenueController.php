<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Revenue;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class RevenueController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $project_id = \Input::get("project_id");
        $project = Project::find($project_id);
        return view('revenue.create', ['project'=>$project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Revenue::create($request->all());

        Session::flash('flash_message', 'Revenue successfully added!');

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
        $revenue = Revenue::findOrFail($id);

        return view('revenue.edit', compact('revenue'));
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

        Session::flash('flash_message', 'Revenue successfully updated!');

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

        Session::flash('flash_message', 'Revenue successfully deleted!');

        return redirect(route('project.show', $revenue->project_id));
    }

}
