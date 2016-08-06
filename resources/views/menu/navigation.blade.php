
<aside id="left-panel">
    <nav>
        <ul>
            <li class="{{ set_active(['/']) }}">
                <a href="{{ url("/") }}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
            </li>
            <li class="{{ set_active(['project*']) }}">
                <a href="{{ url('project') }}"><i class="fa fa-lg fa-fw fa-inbox"></i> <span
                            class="menu-item-parent">Projects</span></a>
            </li>
            @if( Auth::user()->role_id == TWO)
                @include('menu.staff')
                @include('menu.reports')
                @include('menu.reportico')
            @elseif( Auth::user()->role_id == THREE)
                @include('menu.reports')
            @else
                <li class="{{ set_active(['shared-cost*']) }}">
                    <a href="{{ url('shared-cost') }}"><i class="fa fa-lg fa-fw fa-inbox"></i> <span class="menu-item-parent">Shared Cost</span></a>

                @include('menu.staff')

                @include('menu.reports')

                <li class="{{ set_active(['user*']) }}">
                    <a href="{{ url('user') }}"><i class="fa fa-lg fa-fw fa-user"></i> <span
                                class="menu-item-parent">User Management</span></a>
                </li>
                @include('menu.reportico')
            @endif
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>