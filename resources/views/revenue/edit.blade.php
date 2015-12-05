@extends('layouts.master')

@section('content')

    <h1>Edit Revenue for {{ $revenue->project->name }}</h1>
    <hr/>

    {!! Form::model($revenue, [
        'method' => 'PATCH',
        'route' => ['revenue.update', $revenue->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                {!! Form::label('description', 'Description: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('description', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                {!! Form::label('amount', 'Amount: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('received_on') ? 'has-error' : ''}}">
                {!! Form::label('received_on', 'Received On: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('received_on', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('received_on', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::hidden('project_id') !!}
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