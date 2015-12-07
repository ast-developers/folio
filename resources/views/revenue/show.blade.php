@extends('layouts.master')

@section('content')

    <h1>Revenue</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Description</th><th>Amount</th><th>Received On</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $revenue->id }}</td> <td> {{ $revenue->description }} </td><td> {{ money($revenue->amount)
                        }} </td><td> {{ date_formation($revenue->received_on) }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection