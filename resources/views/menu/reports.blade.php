<li class="top-menu-invisible">
    <a href="#"><i class="fa fa-lg fa-fw fa-cube txt-color-blue"></i> <span
                class="menu-item-parent">Reports</span></a>
    <ul>
        <li class="{{ set_active(['report/project']) }}">
            <a href="{{ url('report/project') }}"><i class="fa fa-stack-overflow"></i> Project Performance</a>
        </li>
        <li class="{{ set_active(['report/monthly']) }}">
            <a href="{{ url('report/monthly') }}"><i class="fa fa-cube"></i> Monthly Performance</a>
        </li>
        @if(isset($report_menu))
        @foreach($report_menu as $projects=>$reports)
            <li class="top-menu-invisible">
                <a href="#"><i class="fa fa-lg fa-fw fa-cube txt-color-blue"></i> <span
                            class="menu-item-parent">{!! $projects !!}</span></a>
                <ul>
                    @foreach($reports as $value)
                        <li class="{{ set_active(['report/'.$projects.'/'.$value]) }}">
                            <a href="{{ url('report/'.$projects.'/'.$value) }}"><i class="fa fa-stack-overflow"></i> {!! $value !!}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
        @endif
    </ul>
</li>