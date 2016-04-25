@extends('layouts.master')

@section('content')

    <h1>Staff
        @if( Auth::user()->role_id != 2)
        <a href="{{ route('staff.create') }}" class="btn btn-primary pull-right btn-sm">Add New Staff</a>
        @endif
    </h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>User Name</th><th>Email</th> @if( Auth::user()->role_id != 2)<th>Actions</th>@endif
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($staff as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/staff', $item->id) }}">{{ $item->user_name }}</a></td><td>{{ $item->email }}</td>
                    @if( Auth::user()->role_id != 2)
                    <td>
                        <a href="{{ route('staff.edit', $item->id) }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' => ['staff.destroy', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs delete']) !!}
                        {!! Form::close() !!}
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $staff->render() !!} </div>
    </div>

@endsection
