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


    <li class="nav-item">
    <a href="{{ route('sub-kriteria.index') }}" class="nav-link {{ Request::is('sub-kriteria*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th-list"></i>
        <p>Data Sub Kriteria</p>
    </a>
</li>


    <li class="nav-item">
    <a href="{{ route('alternatif.index') }}" class="nav-link {{ Request::is('alternatif*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Data Alternatif</p>
    </a>
</li>


    <li class="nav-item">
    <a href="{{ route('penilaian.index') }}" class="nav-link {{ Request::is('penilaian*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-star"></i>
        <p>Data Penilaian</p>
    </a>
</li>


    <li class="nav-item">
    <a href="{{ route('perhitungan.index') }}" class="nav-link {{ Request::is('perhitungan*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calculator"></i>
        <p>Data Perhitungan</p>
    </a>
</li>


    <li class="nav-item">
    <a href="{{ route('hasil-akhir.index') }}" class="nav-link {{ Request::is('hasil-akhir*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-trophy"></i>
        <p>Data Hasil Akhir</p>
    </a>
</li>


    <hr class="sidebar-divider">
    <div class="sidebar-heading">PENGATURAN</div>

    @auth
    {{-- menu lain (dashboard, kriteria, dst) tampil untuk semua role --}}

    @if(auth()->user()->role === 'admin')
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>Data User</p>
        </a>
    </li>
    @endif
@endauth


    <li class="nav-item">
    <a href="{{ route('profile.index') }}" class="nav-link {{ Request::is('profile*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-circle"></i>
        <p>Profile Saya</p>
    </a>
</li>

</ul>
