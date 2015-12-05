<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Revenue;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class RevenueController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $revenues = Revenue::paginate(15);

        return view('revenue.index', compact('revenues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('revenue.create');
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

        return redirect('revenue');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $revenue = Revenue::findOrFail($id);

        return view('revenue.show', compact('revenue'));
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

        return redirect('revenue');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Revenue::destroy($id);

        Session::flash('flash_message', 'Revenue successfully deleted!');

        return redirect('revenue');
    }

}
