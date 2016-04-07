@extends('layouts.master')

@section('content')
    <h1>Add New User</h1>
    <hr/>

    {!! Form::open(['route' => 'user.store', 'class' => 'form-horizontal']) !!}

    <div class="form-group {{ $errors->has('staff_id') ? 'has-error' : ''}}">
        {!! Form::label('email', 'User: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('email', $staff, null, ['class' =>
            'form-control']) !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('staff_id') ? 'has-error' : ''}}">
        {!! Form::label('role_id', 'Role: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('role_id', $user_roles, null, ['class' =>
            'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@endsection