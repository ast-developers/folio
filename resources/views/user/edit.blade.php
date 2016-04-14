@extends('layouts.master')

@section('content')

    <h1>Edit User</h1>
    <hr/>

    {!! Form::model($user, [
        'method' => 'PATCH',
        'route' => ['user.update', $user->id],
        'class' => 'form-horizontal'
    ]) !!}


    <div class="form-group ">
        {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('user_id', $user->id, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group ">
        {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('role', 'Role: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('role',( ['' => 'Select Roles'] + $user->userRole->lists('user_role_name','id')->except(ONE)->toArray() ), $user->role_id, ['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('project', 'Project: ', ['class' => 'col-sm-3 control-label']) !!}
        <div  class="col-sm-6 project">
            {!! Form::select('project_ids[]', $projects,$selected_project_list, ['class' =>
                                 'form-control','multiple' => true]) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        <div class=" col-sm-3">
            <a href="{!! route('user.index') !!}" class="btn btn-primary form-control">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}

@endsection