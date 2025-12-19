@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Profil Saya</h3>
                    <div class="card-tools">
                        <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit Profil
                        </a>
                        <a href="{{ route('profile.edit-password') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-key"></i> Ubah Password
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">
                        <!-- Kolom Kiri - Info Profil -->
                        <div class="col-md-4">
                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    <i class="fas fa-user-circle fa-7x text-primary"></i>
                                </div>
                                <h4>{{ $user->name }}</h4>
                                @if($user->role == 'admin')
                                    <span class="badge badge-danger badge-lg">
                                        <i class="fas fa-user-shield"></i> Administrator
                                    </span>
                                @else
                                    <span class="badge badge-secondary badge-lg">
                                        <i class="fas fa-user"></i> User
                                    </span>
                                @endif
                            </div>

                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="text-muted mb-3">
                                        <i class="fas fa-info-circle"></i> Informasi Akun
                                    </h6>
                                    <p class="mb-2">
                                        <i class="fas fa-envelope text-primary"></i> 
                                        <strong>Email:</strong><br>
                                        {{ $user->email }}
                                    </p>
                                    <p class="mb-2">
                                        <i class="fas fa-calendar text-success"></i> 
                                        <strong>Bergabung:</strong><br>
                                        {{ $user->created_at->format('d F Y') }}
                                    </p>
                                    <p class="mb-0">
                                        <i class="fas fa-clock text-info"></i> 
                                        <strong>Terakhir Update:</strong><br>
                                        {{ $user->updated_at->format('d F Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan - Detail & Statistik -->
                        <div class="col-md-8">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-id-card"></i> Detail Profil
                            </h5>
                            
                            <table class="table table-bordered">
                                <tr>
                                    <th width="35%">ID User</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td><strong>{{ $user->name }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Role/Jabatan</th>
                                    <td>
                                        @if($user->role == 'admin')
                                            <span class="badge badge-danger">
                                                <i class="fas fa-user-shield"></i> Administrator
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                <i class="fas fa-user"></i> User
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
</tr>

                                <tr>
                                    <th>Terdaftar Sejak</th>
                                    <td>
                                        {{ $user->created_at->format('d F Y, H:i') }}
                                        <br>
                                        <small class="text-muted">({{ $user->created_at->diffForHumans() }})</small>
                                    </td>
                                </tr>
                            </table>

                            <!-- Hak Akses -->
                            <div class="alert alert-info mt-3">
                                <h6><i class="fas fa-lock"></i> Hak Akses Anda:</h6>
                                @if($user->role == 'admin')
                                    <ul class="mb-0">
                                        <li>Akses penuh ke semua menu dan fitur sistem</li>
                                        <li>Mengelola data kriteria, sub kriteria, dan alternatif</li>
                                        <li>Melakukan penilaian dan perhitungan SMART</li>
                                        <li>Mengelola data user dan melihat hasil akhir</li>
                                        <li>Export laporan dalam format PDF</li>
                                    </ul>
                                @else
                                    <ul class="mb-0">
                                        <li>Akses User terbatas</li>
                                        <li>Melihat hasil perhitungan dan ranking supplier</li>
                                        <li>Akses terbatas untuk mengedit dan menghapus data</li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
