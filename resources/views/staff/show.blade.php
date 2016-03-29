@extends('layouts.master')

@section('content')

    <h1>Staff</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>User Name</th><th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $staff->id }}</td> <td> {{ $staff->user_name }} </td><td> {{ $staff->email }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection