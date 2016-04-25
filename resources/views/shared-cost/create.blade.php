@extends('layouts.master')

@section('content')

    <h1>Create New Sharedcost</h1>
    <hr/>

    {!! Form::open(['route' => 'shared-cost.store', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                {!! Form::label('amount', 'Amount (USD): ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('amount', null, ['class' => 'form-control', 'step'=>'0.01']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('incurred_on') ? 'has-error' : ''}}">
                {!! Form::label('incurred_on', 'Incurred On: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('incurred_on', null, ['class' => 'form-control datepicker' , 'placeholder'=>'YYYY-MM-DD' ]) !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        <div class=" col-sm-3">
            <a href="{!! route('shared-cost.index') !!}" class="btn btn-primary form-control">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}

@endsection