@extends('layouts.master')

@section('js')
    {!! HTML::script("js/custom/manage_project.js") !!}
@endsection
@section('content')

    <h1>Projects</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Jira Key</th>
                <th>Start Date</th>
                <th>Assign to</th>
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
                    <td>
                        {!!  Form::label(MANAGER) !!}
                        {!!  Form::radio('roles', MANAGER, false, array('class' => 'roles','data-project-id'=>$item->id)) !!}

                        {!!  Form::label(SALES) !!}
                        {!!  Form::radio('roles', SALES, false, array('class' => 'roles','data-project-id'=>$item->id))  !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $projects->render() !!} </div>
    </div>



@endsection
