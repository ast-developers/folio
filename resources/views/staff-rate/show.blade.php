@extends('layouts.master')

@section('content')

    <h1>Staffrate</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Staff Id</th><th>Rate</th><th>Effective Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $staffrate->id }}</td>
                    <td> {{ $staffrate->staff_id }} </td>
                    <td> {{ $staffrate->rate }}</td>
                    <td> {{ date_formation($staffrate->effective_date) }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection