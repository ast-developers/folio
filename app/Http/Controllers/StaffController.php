<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest  ;
use App\Http\Controllers\Controller;

use App\Staff;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Session;

class StaffController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
			$staff = Staff::paginate(PAGINATE_LIMIT);
			return view('staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StaffRequest $request)
    {
        
        Staff::create($request->all());

        Session::flash('message', 'Staff successfully added!');

        return redirect('staff');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $staff = Staff::findOrFail($id);

        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $staff = Staff::findOrFail($id);

        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, StaffRequest $request)
    {
        
        $staff = Staff::findOrFail($id);
        $staff->update($request->all());

        Session::flash('message', 'Staff successfully updated!');

        return redirect('staff');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Staff::destroy($id);

        Session::flash('message', 'Staff successfully deleted!');

        return Redirect::back();
    }

}
