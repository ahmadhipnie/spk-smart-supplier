<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div style="display:flex; align-items:center; gap:8px;">
            <img src="{{ asset('img/logo2.png') }}" alt="logo" style="width:50px; height:50px; object-fit:contain;">
            <div class="sidebar-brand-text mx-3" style="font-weight:700;">SPK SMART</div>
        </div>
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
        <span>Data Supplier</span>
    </a>
</li>

    
    <li class="nav-item">
    <a href="{{ route('kriteria.index') }}" class="nav-link {{ Request::is('kriteria*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <span>Data Kriteria</span>
    </a>
</li>


    <li class="nav-item">
    <a href="{{ route('sub-kriteria.index') }}" class="nav-link {{ Request::is('sub-kriteria*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th-list"></i>
        <span>Data Sub Kriteria</span>
    </a>
</li>


    <li class="nav-item">
    <a href="{{ route('alternatif.index') }}" class="nav-link {{ Request::is('alternatif*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <span>Data Alternatif</span>
    </a>
</li>


    <li class="nav-item">
    <a href="{{ route('penilaian.index') }}" class="nav-link {{ Request::is('penilaian*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-star"></i>
        <span>Data Penilaian</span>
    </a>
</li>


    <li class="nav-item">
    <a href="{{ route('perhitungan.index') }}" class="nav-link {{ Request::is('perhitungan*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calculator"></i>
        <span>Data Perhitungan</span>
    </a>
</li>


    <li class="nav-item">
    <a href="{{ route('hasil-akhir.index') }}" class="nav-link {{ Request::is('hasil-akhir*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-trophy"></i>
        <span>Data Hasil Akhir</span>
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
            <span>Data User</span>
        </a>
    </li>
    @endif
@endauth


    <li class="nav-item">
    <a href="{{ route('profile.index') }}" class="nav-link {{ Request::is('profile*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-circle"></i>
        <span>Profile Saya</span>
    </a>
</li>

</ul>
