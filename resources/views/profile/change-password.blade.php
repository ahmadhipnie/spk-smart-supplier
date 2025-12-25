@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-warning">
                    <h3 class="card-title" style="color: white;">
                        <i class="fas fa-key"></i> Ubah Password
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('profile.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('profile.update-password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            <strong>Perhatian:</strong> Pastikan password baru Anda kuat dan mudah diingat. Password minimal 8 karakter.
                        </div>

                        <div class="form-group">
                            <label for="current_password">Password Lama <span class="text-danger">*</span></label>
                            <input type="password" name="current_password" id="current_password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   placeholder="Masukkan password lama Anda">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Masukkan password yang saat ini Anda gunakan</small>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="new_password">Password Baru <span class="text-danger">*</span></label>
                            <input type="password" name="new_password" id="new_password" 
                                   class="form-control @error('new_password') is-invalid @enderror" 
                                   placeholder="Masukkan password baru (minimal 8 karakter)">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                                   class="form-control" 
                                   placeholder="Ulangi password baru">
                        </div>

                        <div class="alert alert-warning">
                            <h6><i class="fas fa-shield-alt"></i> Tips Keamanan Password:</h6>
                            <ul class="mb-0">
                                <li>Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol</li>
                                <li>Minimal 8 karakter atau lebih</li>
                                <li>Jangan gunakan informasi pribadi yang mudah ditebak</li>
                                <li>Hindari password yang sama dengan website lain</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-key"></i> Ubah Password
                        </button>
                        <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
