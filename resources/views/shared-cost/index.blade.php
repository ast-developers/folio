@extends('layouts.master')

@section('content')

    <h1>Sharedcosts <a href="{{ route('shared-cost.copy') }}" class="btn btn-primary pull-right btn-sm" style="margin-left:5px;">Copy</a> <a href="{{ route('shared-cost.create') }}" class="btn btn-primary pull-right btn-sm">Add New Sharedcost</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Name</th><th>Amount</th><th>Incurred On</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($sharedcosts as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('/shared-cost', $item->id) }}">{{ $item->name }}</a></td>
                    <td>{{ money($item->amount) }}</td>
                    <td>{{ date_formation($item->incurred_on) }}</td>
                    <td>
                        <a href="{{ route('shared-cost.edit', $item->id) }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' => ['shared-cost.destroy', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs delete']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $sharedcosts->render() !!} </div>
    </div>

@endsection
