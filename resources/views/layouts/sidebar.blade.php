<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon"><i class="fas fa-database"></i></div>
        <div class="sidebar-brand-text mx-3">SPK SMART</div>
    </a>
    <hr class="sidebar-divider my-0">
    
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>
        </a>
    </li>
    
    <hr class="sidebar-divider">
    <div class="sidebar-heading">MASTER DATA</div>

    <li class="nav-item">
    <a href="{{ route('supplier.index') }}" class="nav-link {{ Request::is('supplier*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-truck"></i>
        <p>Data Supplier</p>
    </a>
</li>

    
    <li class="nav-item">
    <a href="{{ route('kriteria.index') }}" class="nav-link {{ Request::is('kriteria*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>Data Kriteria</p>
    </a>
</li>


    <li class="nav-item {{ request()->routeIs('subkriteria.*') ? 'active' : '' }}">
        @if (Route::has('subkriteria.index'))
            <a class="nav-link" href="{{ route('subkriteria.index') }}">
                <i class="fas fa-fw fa-list"></i><span>Data Sub Kriteria</span>
            </a>
        @else
            <a class="nav-link disabled" href="#">
                <i class="fas fa-fw fa-list"></i><span>Data Sub Kriteria</span>
            </a>
        @endif
    </li>

    <li class="nav-item {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('supplier.index') }}">
            <i class="fas fa-fw fa-user-friends"></i><span>Data Alternatif</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('penilaian.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('penilaian.index') }}">
            <i class="fas fa-fw fa-edit"></i><span>Data Penilaian</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('perhitungan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('perhitungan') }}">
            <i class="fas fa-fw fa-calculator"></i><span>Data Perhitungan</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('hasil') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('hasil') }}">
            <i class="fas fa-fw fa-chart-bar"></i><span>Data Hasil Akhir</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">PENGATURAN</div>

    <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
        @if (Route::has('users.index'))
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-fw fa-users-cog"></i><span>Data User</span>
            </a>
        @else
            <a class="nav-link disabled" href="#">
                <i class="fas fa-fw fa-users-cog"></i><span>Data User</span>
            </a>
        @endif
    </li>

    <li class="nav-item {{ request()->routeIs('profile') || request()->routeIs('profile.*') ? 'active' : '' }}">
        @if (Route::has('profile'))
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-fw fa-user"></i><span>Data Profile</span>
            </a>
        @else
            <a class="nav-link disabled" href="#">
                <i class="fas fa-fw fa-user"></i><span>Data Profile</span>
            </a>
        @endif
    </li>
</ul>
