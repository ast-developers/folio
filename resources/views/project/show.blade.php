@extends('layouts.master')

@section('content')

    <h1>{{ $project->name }} </h1>

    <div class="ui-tabs">
        <ul>
            <li>
                <a href="#overview">Overview</a>
            </li>
            <li>
                <a href="#cost">Costs</a>
            </li>
            <li>
                <a href="#revenue">Revenue</a>
            </li>
        </ul>
        <div id="overview">
            @include('reports.performance', ['performance'=>$performance])

        </div>
        <div id="cost">
            @include('cost.index', ['costs'=>$project->costs])
        </div>
        <div id="revenue">
            @include('revenue.index', ['revenues'=>$project->revenues, 'project_id'=>$project->id])
        </div>
    </div>

@endsection