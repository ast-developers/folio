<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SharedCost;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;

class SharedCostController extends Controller
{

	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index()
	{

		if (session('from_date') != NULL) {
			$sharedcosts = SharedCost::whereBetween('incurred_on', [session('from_date'), session('to_date')])->paginate(PAGINATE_LIMIT);
		} else {
			$sharedcosts = SharedCost::paginate(PAGINATE_LIMIT);
		}


		return view('shared-cost.index', compact('sharedcosts'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Response
	 */
	public function create()
	{
		return view('shared-cost.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * @return Response
	 */
	public function store(Request $request)
	{

		SharedCost::create($request->all());

		Session::flash('flash_message', 'SharedCost successfully added!');

		return redirect('shared-cost');
	}

	/**
	 * Display the specified resource.
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		$sharedcost = SharedCost::findOrFail($id);

		return view('shared-cost.show', compact('sharedcost'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		$sharedcost = SharedCost::findOrFail($id);

		return view('shared-cost.edit', compact('sharedcost'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param  int $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{

		$sharedcost = SharedCost::findOrFail($id);
		$sharedcost->update($request->all());

		Session::flash('flash_message', 'SharedCost successfully updated!');

		return redirect('shared-cost');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		SharedCost::destroy($id);

		Session::flash('flash_message', 'SharedCost successfully deleted!');

		return redirect('shared-cost');
	}

	public function copy(Request $request)
	{
		if ($request->isMethod('post')) {
			DB::statement('INSERT INTO shared_costs(name, amount, incurred_on) SELECT name, amount, :to as incurred_on FROM shared_costs WHERE MONTH(incurred_on)=MONTH(:from)', $request->only(['from', 'to']));
			Session::flash('flash_message', 'SharedCost successfully copied!');
			return redirect('shared-cost');
		} else {
			return view('shared-cost.copy');
		}
	}

}
