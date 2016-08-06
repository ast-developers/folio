@extends('layouts.master')

@section('content')
    <h1>Add New User</h1>
    <hr/>

    {!! Form::open(['route' => 'user.store', 'class' => 'form-horizontal']) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('role', 'Role: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('role',(['' => 'Select Roles'] + $user_roles) ,null, ['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('project', 'Project: ', ['class' => 'col-sm-3 control-label']) !!}
        <div  class="col-sm-6 project">
            {!! Form::select('project_ids[]', $projects,null, ['class' =>'form-control','multiple' => true]) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        <div class=" col-sm-3">
            <a href="{!! route('user.index') !!}" class="btn btn-primary form-control">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}

@endsection