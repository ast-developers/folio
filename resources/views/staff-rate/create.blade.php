@extends('layouts.master')

@section('content')

    <h1>Create New Staffrate</h1>
    <hr/>

    {!! Form::open(['route' => 'staff-rate.store', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('staff_id') ? 'has-error' : ''}}">
                {!! Form::label('staff_id', 'Staff Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('staff_id', $staff->lists('email', 'id'), null, ['class' =>
                    'form-control']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('rate') ? 'has-error' : ''}}">
                {!! Form::label('rate', 'Rate: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('rate', null, ['class' => 'form-control', 'step'=>'0.01']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('effective_date') ? 'has-error' : ''}}">
                {!! Form::label('effective_date', 'Effective Date: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('effective_date', null, ['class' => 'form-control datepicker' , 'placeholder'=> 'YYYY-MM-DD']) !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        <div class=" col-sm-3">
            <a href="{!! route('staff-rate.index') !!}" class="btn btn-primary form-control">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}

@endsection