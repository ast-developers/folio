<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRateRequest;
use App\Http\Controllers\Controller;
use App\Staff;
use App\StaffRate;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Session;

class StaffRateController extends Controller
{

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{
		if (session('from_date') != NULL) {
			$staffrates = StaffRate::with('staff')->whereBetween('effective_date', [session('from_date'), session('to_date')])->paginate(PAGINATE_LIMIT);
		} else {
			$staffrates = StaffRate::with('staff')->paginate(PAGINATE_LIMIT);
		}

		return view('staff-rate.index', compact('staffrates'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create()
	{
		$staff = Staff::orderBy("user_name")->get();
		return view('staff-rate.create', ['staff' => $staff]);
	}

	/**
	 * Store a newly created resource in storage.
	 * @return Response
	 */
	public function store(StaffRateRequest $request)
	{

		StaffRate::create($request->all());

		Session::flash('message', 'StaffRate successfully added!');

		return redirect('staff-rate');
	}

	/**
	 * Display the specified resource.
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		$staffrate = StaffRate::findOrFail($id);

		return view('staff-rate.show', compact('staffrate'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		$staff     = Staff::all();
		$staffrate = StaffRate::findOrFail($id);

		return view('staff-rate.edit', compact('staffrate', 'staff'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param  int $id
	 * @return Response
	 */
	public function update($id, StaffRateRequest $request)
	{

		$staffrate = StaffRate::findOrFail($id);
		$staffrate->update($request->all());

		Session::flash('message', 'StaffRate successfully updated!');

		return redirect('staff-rate');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		StaffRate::destroy($id);

		Session::flash('message', 'StaffRate successfully deleted!');

		return Redirect::back();
	}

}
