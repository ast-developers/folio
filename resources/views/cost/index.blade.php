<h1>Costs</h1>
<div class="table">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>S.No</th><th>Name</th><th>Amount</th><th>Rate</th><th>Hours</th>
        </tr>
        </thead>
        <tbody>
        {{-- */$x=0;/* --}}
        @foreach($costs as $cost)
            {{-- */$x++;/* --}}
            <tr>
                <td>{{ $x }}</td>
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
    </table>

</div>

