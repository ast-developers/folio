@extends('layouts.master')

@section('content')

    <h1>{{ $project->name }} </h1>

    <div class="ui-tabs">
        <ul>
            <li>
                <a href="#tabs-a">Overview</a>
            </li>
            <li>
                <a href="#tabs-b">Costs</a>
            </li>
            <li>
                <a href="#tabs-c">Revenue</a>
            </li>
        </ul>
        <div id="tabs-a">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID.</th> <th>Name</th><th>Jira Key</th><th>Start Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $project->id }}</td> <td> {{ $project->name }} </td><td> {{ $project->jira_key }} </td><td> {{ $project->start_date }} </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="tabs-b">
            @include('cost.index', ['costs'=>$project->costs])
        </div>
        <div id="tabs-c">
            @include('revenue.index', ['revenues'=>$project->revenues, 'project_id'=>$project->id])
        </div>
    </div>

@endsection