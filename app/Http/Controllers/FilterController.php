<?php

namespace App\Http\Controllers;

use App\Interfaces\ProjectRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public  $project_repository;
    public function __construct(ProjectRepositoryInterface $project)
    {
        $this->project_repository=$project;
    }
    public function dateFilter(Request $req)
    {
        session(['from_date' => $req['from_date'] , 'to_date' => $req['to_date']]);
        $projects = $this->project_repository->getAssignedProjects();
        session(['projects' => $projects]);
    }
}
