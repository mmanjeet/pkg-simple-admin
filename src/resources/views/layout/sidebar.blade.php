<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="javascript:void(0);">
            <span class="align-middle">{{ config('singleadmin.GLOBAL.LOGO') }}</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Navigation</li>

            <li class="sidebar-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('admin/profile') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('profile') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            <li class="sidebar-header">Settings</li>

        </ul>


    </div>
</nav>