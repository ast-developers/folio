@extends('layouts.master')

@section('content')

    <h1>Copy Sharedcost</h1>
    <hr/>

    {!! Form::open(['route' => 'shared-cost.copy', 'class' => 'form-horizontal']) !!}

            <div class="form-group {{ $errors->has('from') ? 'has-error' : ''}}">
                {!! Form::label('from', 'Copy From: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('from', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('from', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            
            <div class="form-group {{ $errors->has('to') ? 'has-error' : ''}}">
                {!! Form::label('to', 'Copy To: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('to', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('to', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Copy', ['class' => 'btn btn-primary form-control']) !!}
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