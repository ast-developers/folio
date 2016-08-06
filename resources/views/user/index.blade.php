 @extends('layouts.master')

@section('content')

    <h1>User
            <a href="{{ route('user.create') }}" class="btn btn-primary pull-right btn-sm">Add New User</a>
    </h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th><th>Email</th><th>Role</th> <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($users as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/user', $item->id) }}">{{ $item->email }}</a></td><td>{{ $item->userRole->user_role_name }}</td>

                        <td>
                            <a href="{{ route('user.edit', $item->id) }}">
                                <button type="submit" class="btn btn-primary btn-xs">Update</button>
                            </a>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'route' => ['user.destroy', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs delete']) !!}
                            {!! Form::close() !!}
                        </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $users->render() !!} </div>
    </div>

@endsection
