@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Sub Kriteria</h3>
                    <div class="card-tools">
                        <a href="{{ route('sub-kriteria.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('sub-kriteria.update', $subKriteria->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kriteria_id">Kriteria <span class="text-danger">*</span></label>
                            <select name="kriteria_id" id="kriteria_id" 
                                    class="form-control @error('kriteria_id') is-invalid @enderror">
                                <option value="">-- Pilih Kriteria --</option>
                                @foreach($kriteria as $k)
                                    <option value="{{ $k->id }}" 
                                        {{ old('kriteria_id', $subKriteria->kriteria_id) == $k->id ? 'selected' : '' }}>
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
                                   value="{{ old('nama_sub_kriteria', $subKriteria->nama_sub_kriteria) }}" 
                                   placeholder="Contoh: Sangat Baik / < Rp 5.000.000">
                            @error('nama_sub_kriteria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nilai">Nilai Parameter <span class="text-danger">*</span></label>
                            <input type="number" name="nilai" id="nilai" 
                                   class="form-control @error('nilai') is-invalid @enderror" 
                                   value="{{ old('nilai', $subKriteria->nilai) }}" 
                                   step="0.01" min="0" max="100"
                                   placeholder="Contoh: 100">
                            @error('nilai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" 
                                      class="form-control @error('keterangan') is-invalid @enderror" 
                                      rows="3" 
                                      placeholder="Deskripsi sub kriteria (opsional)">{{ old('keterangan', $subKriteria->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
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
