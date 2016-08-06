@extends('layouts.master')

@section('content')
    {{ $report_object->execute() }}
@stop

@section('js')
    {!! HTML::script("js/custom/dropdown.js") !!}
@stop