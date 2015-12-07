<div class="table">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>Month</th>
            <th>Cost</th>
            <th>Revenue</th>
            <th>Profit</th>
        </tr>
        </thead>
        <tbody>
        {{-- */$x=0;/* --}}
        @foreach($performance as $row)

            {{-- */$x++;/* --}}
            <tr>
                <td>{{ $row->month_logged  }}</td>
                <td class="text-right"> {{money($row->cost) }}</td>
                <td class="text-right"> {{money($row->revenue) }}</td>
                <td class="text-right"> {{money($row->revenue - $row->cost) }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>Total</th>
            <th class="text-right"> {{number_format($performance->sum('cost'))}}</th>
            <th class="text-right"> {{number_format($performance->sum('revenue'))}}</th>
            <th class="text-right"> {{number_format($performance->sum('revenue')-$performance->sum('cost'))}}</th>
        </tr>

        </tfoot>
    </table>

</div>