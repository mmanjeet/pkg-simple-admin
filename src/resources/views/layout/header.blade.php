@php
$profile_pic=!empty(auth()->user()->profile_pic) ? asset('storage/'.auth()->user()->profile_pic) : asset('cyberzet/single-admin/assets/img/avatars/avatar-6.png') ;
@endphp
<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="{{ $profile_pic }}" class="avatar img-fluid rounded me-1" alt="{{ auth()->user()->fname ?? '' }} {{ auth()->user()->lname ?? '' }}" /> <span class="text-dark">{{ auth()->user()->fname ?? '' }} {{ auth()->user()->lname ?? '' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                    <!--<div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="settings"></i> Settings</a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>