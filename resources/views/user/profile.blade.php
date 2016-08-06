@extends('layouts.master')

@section('content')

    <h1>Profile</h1>
    <hr/>
    {!! Form::model($user, [
           'method' => 'PATCH',
           'route' => ['profile.update', $user->id],
           'class' => 'form-horizontal'
       ]) !!}


    <div class="form-group ">
        {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', NULL, ['class' => 'form-control']) !!}
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
            {!! Form::text('role', $user->userRole->user_role_name, ['class' => 'form-control' ,'readonly']) !!}
        </div>
    </div>
    <div class="form-group ">
            {!! Form::label('password', 'Password: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        <div class=" col-sm-3">
            <a href="{!! url('/') !!}" class="btn btn-primary form-control">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}

@endsection