@extends('layouts.master')

@section('content')

    <h1>Create New Project</h1>
    <hr/>

    {!! Form::open(['route' => 'project.store', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('jira_key') ? 'has-error' : ''}}">
                {!! Form::label('jira_key', 'Jira Key: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('jira_key', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('jira_key', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
                {!! Form::label('start_date', 'Start Date: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
                {!! Form::label('end_date', 'End Date: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('is_overhead') ? 'has-error' : ''}}">
                {!! Form::label('is_overhead', 'Is Overhead: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('is_overhead', '1') !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('is_overhead', '0', true) !!} No</label>
            </div>
                    {!! $errors->first('is_overhead', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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