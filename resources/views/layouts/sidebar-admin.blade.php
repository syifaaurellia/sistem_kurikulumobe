<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('sbadmin2/img/logo_kampus.png') }}" alt="Logo Kampus" style="width: 40px; height: auto;">
        </div>
        <div class="sidebar-brand-text mx-3 font-weight-bold">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Kelola Akun -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-users"></i>
            <span>Kelola Akun</span>
        </a>
    </li>

</ul>
