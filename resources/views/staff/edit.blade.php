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
                    {!! Form::hidden('id',null) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        <div class=" col-sm-3">
            <a href="{!! route('staff.index') !!}" class="btn btn-primary form-control">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}

@endsection