@extends('layouts.master')

@section('js')
    {!! HTML::script("js/custom/manage_roles.js") !!}
    @endsection
@section('content')

    <h1>Manage Role
        <a href="{{ route('user.create') }}" class="btn btn-primary pull-right btn-sm">Add New User</a>
    </h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th><th>User Email-Id</th><th>Role</th><th>Change Role</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($users as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->userRole->user_role_name }}
                    </td>
                    <td>
                       {!!  Form::label(\App\UserRoles::SALES) !!}
                       {!!  Form::radio('roles', \App\UserRoles::SALES, false, array('class' => 'roles','data-user-id'=>$item->id))  !!}
                        {!!  Form::label(\App\UserRoles::MANAGER) !!}
                       {!!  Form::radio('roles', \App\UserRoles::MANAGER, false, array('class' => 'roles','data-user-id'=>$item->id)) !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $users->render() !!} </div>
    </div>
@endsection