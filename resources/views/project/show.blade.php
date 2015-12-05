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
            <p>
                Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.
            </p>
        </div>
        <div id="tabs-c">
            <p>
                Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.
            </p>
        </div>
    </div>

@endsection