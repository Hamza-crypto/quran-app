@php
    $role = Auth()->user()->role;
@endphp
<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('dashboard.index') }}">
            <span class="align-middle me-3">{{ env("APP_NAME") }}</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                General
            </li>
            <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                Order Requests
            </li>
            <li class="sidebar-item {{ request()->is('orders') ? 'active' : '' }}">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="grid"></i>
                    <span class="align-middle">All Orders</span>
                </a>
            </li>
            @if( $role == 'user')
                <li class="sidebar-item {{ request()->is('orders/create') ? 'active' : '' }}">
                    <a class="sidebar-link" href="#">
                        <i class="align-middle" data-feather="plus-square"></i>
                        <span class="align-middle">Add New Order</span>
                    </a>
                </li>

            @endif


            <li class="sidebar-header">
                Manage
            </li>
            <li class="sidebar-item {{ request()->is('users*') ? 'active' : '' }} ">
                <a data-target="#users" data-toggle="collapse" class="sidebar-link {{ request()->is('users/*') ? 'collapsed' : '' }}">
                    <i class="align-middle" data-feather="users"></i>
                    <span class="align-middle">Users</span>
                </a>
                <ul id="users"
                    class="sidebar-dropdown list-unstyled collapse {{ request()->is('users*') ? 'show' : '' }}"
                    data-parent="#sidebar">

                    <li class="sidebar-item {{ request()->is('users') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('users.index') }}">
                            <i class="align-middle" data-feather="users"></i>
                            <span class="align-middle">All Users</span>
                        </a>
                    </li>
                </ul>
            </li>






        </ul>
    </div>
</nav>
