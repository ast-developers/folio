@extends('layouts.master')

@section('content')

    <h1>Staffrates <a href="{{ route('staff-rate.create') }}" class="btn btn-primary pull-right btn-sm">Add New Staffrate</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Staff Id</th><th>Rate</th><th>Effective Date</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($staffrates as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/staff-rate', $item->id) }}">{{ $item->staff->email }}</a></td><td>$ {{
                    $item->rate }}</td><td>{{ $item->effective_date }}</td>
                    <td>
                        <a href="{{ route('staff-rate.edit', $item->id) }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' => ['staff-rate.destroy', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $staffrates->render() !!} </div>
    </div>

@endsection
