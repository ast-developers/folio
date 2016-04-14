@extends('layouts.master')

@section('content')
    @if((count($performance))==0)
        <h2>You are not authorized to view this project</h2>
    @else

        <h1>{{ $project->name }}
<button type="button" id="sync-timelog" data-loading-text="Loading..." class="btn btn-primary pull-right"
                      autocomplete="off">
        Sync Timelog
</button>
        </h1><br/>


<div class="ui-tabs"  style="display: none;">
        <ul>
            <li>
                <a href="#overview">Overview</a>
            </li>
            <li>
                @if(Auth::user()->role_id != THREE)<a href="#cost">Costs</a>@endif
            </li>
            <li>
                <a href="#revenue">Revenue</a>
            </li>
        </ul>
        <div id="overview">
            @include('reports.performance', ['performance'=>$performance])

        </div>
        <div id="cost">
            @if(Auth::user()->role_id != THREE)@include('cost.index', ['costs'=>$project->costs])@endif
        </div>
        <div id="revenue">
            @include('revenue.index', ['revenues'=>$project->revenues, 'project_id'=>$project->id])
        </div>
    </div>
    @endif
@endsection