@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail User</h3>
                    <div class="card-tools">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-user-circle"></i> Informasi User
                            </h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="35%">ID User</th>
                                    <td>: {{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>: <strong>{{ $user->name }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: {{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>: 
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
                                    <th>Status Email</th>
                                    <td>: 
                                        @if($user->email_verified_at)
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle"></i> Verified
                                            </span>
                                            <br>
                                            <small class="text-muted">{{ $user->email_verified_at->format('d/m/Y H:i') }}</small>
                                        @else
                                            <span class="badge badge-warning">
                                                <i class="fas fa-clock"></i> Belum Verified
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h5 class="text-success mb-3">
                                <i class="fas fa-clock"></i> Informasi Aktivitas
                            </h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="35%">Terdaftar Sejak</th>
                                    <td>: {{ $user->created_at->format('d F Y, H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Terakhir Diupdate</th>
                                    <td>: {{ $user->updated_at->format('d F Y, H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Lama Bergabung</th>
                                    <td>: {{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                            </table>

                            <div class="mt-4">
                                <h6>Reset Password</h6>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#resetPasswordModal">
                                    <i class="fas fa-key"></i> Reset Password User
                                </button>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> Hak Akses:</h6>
                        @if($user->role == 'admin')
                            <ul class="mb-0">
                                <li>Akses penuh ke semua menu dan fitur</li>
                                <li>Dapat mengelola data kriteria, sub kriteria, alternatif</li>
                                <li>Dapat melakukan penilaian dan perhitungan</li>
                                <li>Dapat mengelola user lain</li>
                            </ul>
                        @else
                            <ul class="mb-0">
                                <li>Akses terbatas untuk melihat data</li>
                                <li>Dapat melihat hasil perhitungan dan ranking</li>
                                <li>Tidak dapat menghapus atau mengubah data penting</li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Reset Password -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('users.reset-password', $user->id) }}" method="POST">
                @csrf
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">
                        <i class="fas fa-key"></i> Reset Password User
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Reset password untuk user: <strong>{{ $user->name }}</strong></p>
                    
                    <div class="form-group">
                        <label for="new_password">Password Baru <span class="text-danger">*</span></label>
                        <input type="password" name="new_password" id="new_password" 
                               class="form-control" 
                               placeholder="Minimal 8 karakter" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                               class="form-control" 
                               placeholder="Ulangi password baru" required>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        User akan menggunakan password baru ini untuk login.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key"></i> Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
