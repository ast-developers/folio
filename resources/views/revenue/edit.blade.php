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
                </div>
            </div>
            <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                {!! Form::label('amount', 'Amount (USD): ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('amount', null, ['class' => 'form-control', 'step'=>'0.01']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('received_on') ? 'has-error' : ''}}">
                {!! Form::label('received_on', 'Received On: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('received_on', null, ['class' => 'form-control datepicker']) !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::hidden('project_id') !!}
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        <div class=" col-sm-3">
            <a href="{!! url('project/'.$revenue->project->id ) !!}" class="btn btn-primary form-control">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}

@endsection