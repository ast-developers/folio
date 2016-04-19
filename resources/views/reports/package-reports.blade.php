@extends('layouts.master')

@section('content')
    {{ $report_object->execute() }}
@stop
