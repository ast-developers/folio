@extends('layouts.master')

@section('content')

    <h1>Projects
        @if( Auth::user()->role_id != THREE)
        <a href="{{ route('project.create') }}" class="btn btn-primary pull-right btn-sm">Add New Project</a>
        @endif
    </h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Name</th><th>Jira Key</th><th>Start Date</th> @if( Auth::user()->role_id != THREE)<th>Actions</th>@endif
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}

            @foreach($projects as $item)
                {{-- */$x++;/* --}}

                    <tr>
                        <td>{{ $x }}</td>
                        <td><a href="{{ url('/project', $item->id) }}">{{ $item->name }}</a></td>
                        <td>{{ $item->jira_key}}</td>
                        <td>{{ date_formation($item->start_date) }}</td>
                        @if( Auth::user()->role_id != THREE)
                        <td>
                            <a href="{{ route('project.edit', $item->id) }}">
                                <button type="submit" class="btn btn-primary btn-xs">Update</button>
                            </a>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'route' => ['project.destroy', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs delete']) !!}
                            {!! Form::close() !!}
                        </td>
                         @endif
                    </tr>

            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $projects->render() !!} </div>
    </div>

@endsection
