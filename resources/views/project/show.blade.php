@extends('layouts.master')

@section('content')

    <h1>Project</h1>
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

@endsection