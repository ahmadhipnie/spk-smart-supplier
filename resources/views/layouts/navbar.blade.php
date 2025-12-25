<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Title -->
    <div class="navbar-text d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0">
       <span class="font-weight-bold">SPK SMART</span>
   </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        @auth
        <!-- User Dropdown (Hanya tampil jika sudah login) -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile.index') }}">
                    <i class="fas fa-user"></i> Profil Saya
                </a>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
                <a class="dropdown-item" href="{{ route('profile.edit-password') }}">
                    <i class="fas fa-key"></i> Ubah Password
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </li>
        @endauth

        @guest
        <!-- Link Login (Hanya tampil jika belum login) -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        </li>
        @endguest
    </ul>
</nav>
