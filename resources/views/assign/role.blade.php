@extends('layouts.master')

@section('js')
    {!! HTML::script("js/custom/manage_roles.js") !!}
    @endsection
@section('content')

    <h1>Manage Role</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th><th>User Name</th><th>Role</th><th>Change Role</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($user as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->name }}</td>
                    <td>@if($item->role_id == 1){!! \App\UserRoles::ADMIN !!}
                        @elseif($item->role_id == 2){!! \App\UserRoles::MANAGER !!}
                        @elseif($item->role_id == 3){!! \App\UserRoles::SALES !!}
                        @elseif($item->role_id == 4){!! \App\UserRoles::GUEST !!}
                        @endif
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
        <div class="pagination"> {!! $user->render() !!} </div>
    </div>
@endsection