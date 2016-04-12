@extends('layouts.master')

@section('content')

    <h1>User</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>User Name</th><th>Email</th><th>Role</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $user->id }}</td>
                    <td> {{ $user->name }} </td>
                    <td> {{ $user->email }}</td>
                    <td> {{ $user->userRole->user_role_name }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection