<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function dateFilter(Request $req)
    {
        session(['from_date' => $req['from_date'] , 'to_date' => $req['to_date']]);
    }
}
