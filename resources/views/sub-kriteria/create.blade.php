@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Sub Kriteria</h3>
                    <div class="card-tools">
                        <a href="{{ route('sub-kriteria.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('sub-kriteria.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kriteria_id">Kriteria <span class="text-danger">*</span></label>
                            <select name="kriteria_id" id="kriteria_id" 
                                    class="form-control @error('kriteria_id') is-invalid @enderror">
                                <option value="">-- Pilih Kriteria --</option>
                                @foreach($kriteria as $k)
                                    <option value="{{ $k->id }}" {{ old('kriteria_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->kode_kriteria }} - {{ $k->nama_kriteria }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kriteria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_sub_kriteria">Nama Sub Kriteria <span class="text-danger">*</span></label>
                            <input type="text" name="nama_sub_kriteria" id="nama_sub_kriteria" 
                                   class="form-control @error('nama_sub_kriteria') is-invalid @enderror" 
                                   value="{{ old('nama_sub_kriteria') }}" 
                                   placeholder="Contoh: Sangat Baik / < Rp 5.000.000">
                            @error('nama_sub_kriteria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Contoh untuk Harga: "< Rp 5.000.000", "Rp 5.000.000 - Rp 7.000.000"<br>
                                Contoh untuk Kualitas: "Sangat Baik", "Baik", "Cukup"
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="nilai">Nilai Parameter <span class="text-danger">*</span></label>
                            <input type="number" name="nilai" id="nilai" 
                                   class="form-control @error('nilai') is-invalid @enderror" 
                                   value="{{ old('nilai') }}" 
                                   step="0.01" min="0" max="100"
                                   placeholder="Contoh: 100">
                            @error('nilai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Nilai utility untuk sub kriteria ini (0-100). Semakin baik semakin tinggi nilainya.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" 
                                      class="form-control @error('keterangan') is-invalid @enderror" 
                                      rows="3" 
                                      placeholder="Deskripsi sub kriteria (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> <strong>Tips:</strong><br>
                            - Untuk kriteria COST (Harga): nilai tertinggi untuk harga termurah<br>
                            - Untuk kriteria BENEFIT: nilai tertinggi untuk kondisi terbaik<br>
                            - Buat beberapa sub kriteria dengan range nilai yang berbeda
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('sub-kriteria.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
