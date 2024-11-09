<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#0"><img src="{{ asset('assets/backend/img/full-logo.png') }}" width="20%"></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#0"><img src="{{ asset('assets/backend/img/logo.png') }}" width="30%"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a>
            </li>
           
            @role('Super Admin')
                <li class="menu-header">Control Panel</li>
                <li class="{{ Request::routeIs('users*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users-cog"></i> <span>Users
                            Management</span></a>
                </li>
                <li class="nav-item dropdown {{ Request::routeIs('agents*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-briefcase"></i>
                        <span>Agents</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::routeIs('agents.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('agents.index') }}">List</a>
                        </li>
                        <li class="{{ Request::routeIs('agents.pending') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ route('agents.pending') }}">Pending</span></a>
                        </li>
                    </ul>
                </li>
            @endrole
            @role('Super Admin|Staff')
                <li class="menu-header">Admission</li>
                <li class="nav-item dropdown {{ Request::routeIs('students*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-user-graduate"></i>
                        <span>Student Management</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::routeIs('students.pending') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('students.pending') }}">New Student</span></a>
                        </li>
                        <li class="{{ Request::routeIs('students.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('students.index') }}">Student List</a>
                        </li>
                    </ul>
                </li>
            @endrole
        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a class="btn btn-primary btn-lg btn-block btn-icon-split" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out"></i> Sign Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

    </aside>
</div>
