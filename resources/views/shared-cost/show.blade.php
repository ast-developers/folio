@extends('layouts.master')

@section('content')

    <h1>Sharedcost</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Name</th><th>Amount</th><th>Incurred On</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $sharedcost->id }}</td> <td> {{ $sharedcost->name }} </td><td> {{ $sharedcost->amount }} </td><td> {{ $sharedcost->incurred_on }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection