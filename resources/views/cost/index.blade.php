<h1>Costs</h1>
<div class="table">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>Name</th><th>Amount</th><th>Rate</th><th>Hours</th>
        </tr>
        </thead>
        <tbody>
        {{-- */$x=0;/* --}}
        @foreach($costs as $cost)

            {{-- */$x++;/* --}}
            <tr>
                <td>{{ $cost->staff->user_name  }}</td>
                <td> ${{$cost->amount }}
                </td>
                <td> ${{$cost->amount/$cost->hours }}
                </td>
                <td> {{$cost->hours }}
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total</th>
                <th> ${{$costs->sum('amount')}}
                </th>
                <th> -
                </th>
                <th> ${{$costs->sum('hours')}}
                </th>
            </tr>
        </tfoot>
    </table>

</div>

