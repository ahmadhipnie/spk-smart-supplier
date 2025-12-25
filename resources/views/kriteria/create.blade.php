@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Kriteria</h3>
                    <div class="card-tools">
                        <a href="{{ route('kriteria.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('kriteria.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kode_kriteria">Kode Kriteria <span class="text-danger">*</span></label>
                            <input type="text" name="kode_kriteria" id="kode_kriteria" 
                                   class="form-control @error('kode_kriteria') is-invalid @enderror" 
                                   value="{{ old('kode_kriteria') }}" 
                                   placeholder="Contoh: C1">
                            @error('kode_kriteria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_kriteria">Nama Kriteria <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kriteria" id="nama_kriteria" 
                                   class="form-control @error('nama_kriteria') is-invalid @enderror" 
                                   value="{{ old('nama_kriteria') }}" 
                                   placeholder="Contoh: Harga">
                            @error('nama_kriteria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jenis_kriteria">Jenis Kriteria <span class="text-danger">*</span></label>
                            <select name="jenis_kriteria" id="jenis_kriteria" 
                                    class="form-control @error('jenis_kriteria') is-invalid @enderror">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="benefit" {{ old('jenis_kriteria') == 'benefit' ? 'selected' : '' }}>
                                    Benefit (Semakin Tinggi Semakin Baik)
                                </option>
                                <option value="cost" {{ old('jenis_kriteria') == 'cost' ? 'selected' : '' }}>
                                    Cost (Semakin Rendah Semakin Baik)
                                </option>
                            </select>
                            @error('jenis_kriteria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="bobot">Bobot (%) <span class="text-danger">*</span></label>
                            <input type="number" name="bobot" id="bobot" 
                                   class="form-control @error('bobot') is-invalid @enderror" 
                                   value="{{ old('bobot') }}" 
                                   step="0.01" min="0" max="100"
                                   placeholder="Contoh: 25.00">
                            @error('bobot')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Total bobot semua kriteria harus 100%</small>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" 
                                      class="form-control @error('keterangan') is-invalid @enderror" 
                                      rows="3" 
                                      placeholder="Deskripsi kriteria (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
