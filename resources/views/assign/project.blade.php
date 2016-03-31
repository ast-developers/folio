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
                <th>Assign to
                    {!!  Form::checkbox('check_all', 'Sales',false, array('class' => 'check_all_sales'))  !!}
                    {!!  Form::label('Sales') !!}
                    {!!  Form::checkbox('check_all', 'Manager', false, array('class' => 'check_all_manager')) !!}
                    {!!  Form::label('Manager') !!}

                </th>
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
                        @if(count($item->assign_projects)==1)

                            @if($item->assign_projects[0]->assigned_to=="Sales")
                                {!!  Form::checkbox('roles', 'Sales',true, array('class' => 'roles','data-project-id'=>$item->id))  !!}
                                {!!  Form::label('Sales') !!}
                            @else
                                {!!  Form::checkbox('roles', 'Sales',false, array('class' => 'roles','data-project-id'=>$item->id))  !!}
                                {!!  Form::label('Sales') !!}
                            @endif
                            @if($item->assign_projects[0]->assigned_to=="Manager" )
                                {!!  Form::checkbox('roles', 'Manager', true, array('class' => 'roles','data-project-id'=>$item->id)) !!}
                                {!!  Form::label('Manager') !!}
                            @else
                                {!!  Form::checkbox('roles', 'Manager', false, array('class' => 'roles','data-project-id'=>$item->id)) !!}
                                {!!  Form::label('Manager') !!}
                            @endif
                        @elseif(count($item->assign_projects)==2)
                            @if($item->assign_projects[0]->assigned_to=="Sales" || $item->assign_projects[1]->assigned_to=="Sales")
                                {!!  Form::checkbox('roles', 'Sales',true, array('class' => 'roles','data-project-id'=>$item->id))  !!}
                                {!!  Form::label('Sales') !!}
                            @else
                                {!!  Form::checkbox('roles', 'Sales',false, array('class' => 'roles','data-project-id'=>$item->id))  !!}
                                {!!  Form::label('Sales') !!}
                            @endif
                            @if($item->assign_projects[0]->assigned_to=="Manager"  || $item->assign_projects[1]->assigned_to=="Manager")
                                {!!  Form::checkbox('roles', 'Manager', true, array('class' => 'roles','data-project-id'=>$item->id)) !!}
                                {!!  Form::label('Manager') !!}
                            @else
                                {!!  Form::checkbox('roles', 'Manager', false, array('class' => 'roles','data-project-id'=>$item->id)) !!}
                                    {!!  Form::label('Manager') !!}
                            @endif
                        @else
                            {!!  Form::checkbox('roles', 'Sales',false, array('class' => 'roles','data-project-id'=>$item->id))  !!}
                            {!!  Form::label('Sales') !!}
                            {!!  Form::checkbox('roles', 'Manager', false, array('class' => 'roles','data-project-id'=>$item->id)) !!}
                            {!!  Form::label('Manager') !!}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $projects->render() !!} </div>
    </div>

@endsection
