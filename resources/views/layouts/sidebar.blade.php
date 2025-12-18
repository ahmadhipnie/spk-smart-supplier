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
    
    <li class="nav-item {{ request()->routeIs('kriteria.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kriteria.index') }}">
            <i class="fas fa-fw fa-database"></i><span>Data Kriteria</span>
        </a>
    </li>
    
    <li class="nav-item {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('supplier.index') }}">
            <i class="fas fa-fw fa-users"></i><span>Data Supplier</span>
        </a>
    </li>
    
    <li class="nav-item {{ request()->routeIs('penilaian.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('penilaian.index') }}">
            <i class="fas fa-fw fa-edit"></i><span>Data Penilaian</span>
        </a>
    </li>
    
    <hr class="sidebar-divider">
    <div class="sidebar-heading">PROSES & HASIL</div>
    
    <li class="nav-item {{ request()->routeIs('perhitungan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('perhitungan') }}">
            <i class="fas fa-fw fa-calculator"></i><span>Perhitungan SMART</span>
        </a>
    </li>
    
    <li class="nav-item {{ request()->routeIs('hasil') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('hasil') }}">
            <i class="fas fa-fw fa-chart-bar"></i><span>Hasil & Ranking</span>
        </a>
    </li>
</ul>
