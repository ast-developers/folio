@extends('layouts.master')

@section('content')
    {{ $report->execute() }}
@stop
