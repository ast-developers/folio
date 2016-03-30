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
                    <td>{{ $item->role}}</td>
                    <td>
{{--
                        {!! Form::select('roles', , 'key', array('class' => 'form-control','id' => 'roles','data-user-id'=>$item->id)) !!}
--}}
                       {!!  Form::label('Sales') !!}
                       {!!  Form::radio('roles', 'Sales', false, array('class' => 'roles','data-user-id'=>$item->id))  !!}
                        {!!  Form::label('Manager') !!}
                       {!!  Form::radio('roles', 'Manager', false, array('class' => 'roles','data-user-id'=>$item->id)) !!}

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $user->render() !!} </div>
    </div>
@endsection