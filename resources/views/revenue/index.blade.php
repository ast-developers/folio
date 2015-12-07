

    <h1>Revenues <a href="{{ route('revenue.create', ['project_id'=>$project_id]) }}" class="btn btn-primary pull-right btn-sm">Add New Revenue</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Description</th><th>Amount</th><th>Received On</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($revenues as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td><a href="{{ url('/revenue', $item->id) }}">{{ $item->description }}</a></td>
                    <td>{{ money($item->amount) }}</td>
                    <td>{{ date_formation($item->received_on) }}</td>
                    <td>
                        <a href="{{ route('revenue.edit', $item->id) }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' => ['revenue.destroy', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <th> {{money($revenues->sum('amount'))}}
                </th>
                <th> -
                </th>
                <th> -
                </th>
            </tr>
            </tfoot>
        </table>

    </div>

