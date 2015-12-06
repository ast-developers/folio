<div class="table">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>Month</th>
            <th>Cost</th>
            <th>Revenue</th>
            <th>Difference</th>
        </tr>
        </thead>
        <tbody>
        {{-- */$x=0;/* --}}
        @foreach($performance as $row)

            {{-- */$x++;/* --}}
            <tr>
                <td>{{ $row->month_logged  }}</td>
                <td class="text-right"> ${{number_format($row->cost,2) }}</td>
                <td class="text-right"> ${{number_format($row->revenue,2) }}</td>
                <td class="text-right"> ${{number_format($row->revenue - $row->cost,2) }}</td>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>Total</th>
            <th class="text-right"> ${{number_format($performance->sum('cost'), 2)}}</th>
            <th class="text-right"> ${{number_format($performance->sum('revenue'), 2)}}</th>
            <th class="text-right"> ${{number_format($performance->sum('revenue')-$performance->sum('cost'), 2)}}</th>
        </tr>

        </tfoot>
    </table>

</div>