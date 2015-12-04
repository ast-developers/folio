@extends('layouts.master')

@section('content')

    <h1>Edit Staff</h1>
    <hr/>

    {!! Form::model($staff, [
        'method' => 'PATCH',
        'route' => ['staff.update', $staff->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('user_name') ? 'has-error' : ''}}">
                {!! Form::label('user_name', 'User Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('user_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('user_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection