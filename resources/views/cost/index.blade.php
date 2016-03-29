<h1>Costs</h1>
<div class="table">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>Month</th>
            <th>Name</th>
            <th>Hours</th>
            <th>Project Cost</th>
            <th>Shared Cost</th>
        </tr>
        </thead>
        <tbody>
        {{-- */$x=0;/* --}}
        @foreach($costs as $cost)

            {{-- */$x++;/* --}}
            <tr>
                <td>{{ month_formation($cost->month_logged)  }}</td>
                <td>{{ $cost->staff->user_name  }}</td>
                <td class="text-right"> {{number_format($cost->hours,2) }}
                <td class="text-right"> {{money($cost->project_cost) }}</td>
                <td class="text-right"> {{money($cost->shared_cost) }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total</th>
                <th> - </th>
                <th class="text-right"> {{number_format($costs->sum('hours'), 2)}}</th>
                <th class="text-right"> {{money($costs->sum('project_cost'))}}</th>
                <th class="text-right"> {{money($costs->sum('shared_cost'))}}</th>
            </tr>
            <tr>
                <th>Total Cost</th>
                <th colspan="4" class="text-right"> {{money($costs->sum('project_cost') + $costs->sum('shared_cost'))}} </th>

            </tr>
        </tfoot>
    </table>

</div>

