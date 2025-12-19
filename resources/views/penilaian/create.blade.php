@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Penilaian</h3>
                    <div class="card-tools">
                        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('penilaian.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="alternatif_id">Pilih Alternatif <span class="text-danger">*</span></label>
                            <select name="alternatif_id" id="alternatif_id" 
                                    class="form-control @error('alternatif_id') is-invalid @enderror">
                                <option value="">-- Pilih Alternatif --</option>
                                @foreach($alternatif as $alt)
                                    <option value="{{ $alt->id }}" {{ old('alternatif_id') == $alt->id ? 'selected' : '' }}>
                                        {{ $alt->kode_alternatif }} - {{ $alt->nama_supplier }}
                                    </option>
                                @endforeach
                            </select>
                            @error('alternatif_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kriteria_id">Pilih Kriteria <span class="text-danger">*</span></label>
                            <select name="kriteria_id" id="kriteria_id" 
                                    class="form-control @error('kriteria_id') is-invalid @enderror">
                                <option value="">-- Pilih Kriteria --</option>
                                @foreach($kriteria as $k)
                                    <option value="{{ $k->id }}" {{ old('kriteria_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->kode_kriteria }} - {{ $k->nama_kriteria }} ({{ ucfirst($k->jenis_kriteria) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('kriteria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sub_kriteria_id">Pilih Sub Kriteria / Nilai <span class="text-danger">*</span></label>
                            <select name="sub_kriteria_id" id="sub_kriteria_id" 
                                    class="form-control @error('sub_kriteria_id') is-invalid @enderror">
                                <option value="">-- Pilih Kriteria Dulu --</option>
                            </select>
                            @error('sub_kriteria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> <strong>Catatan:</strong><br>
                            - Pilih kriteria terlebih dahulu untuk melihat sub kriteria yang tersedia<br>
                            - Satu alternatif hanya bisa memiliki 1 penilaian per kriteria<br>
                            - Gunakan tombol "Nilai" di halaman index untuk input lebih cepat
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('kriteria_id').addEventListener('change', function() {
    let kriteriaId = this.value;
    let subKriteriaSelect = document.getElementById('sub_kriteria_id');
    
    // Reset sub kriteria
    subKriteriaSelect.innerHTML = '<option value="">Loading...</option>';
    
    if (kriteriaId) {
        fetch(`/get-sub-kriteria/${kriteriaId}`)
            .then(response => response.json())
            .then(data => {
                subKriteriaSelect.innerHTML = '<option value="">-- Pilih Sub Kriteria --</option>';
                data.forEach(item => {
                    subKriteriaSelect.innerHTML += `<option value="${item.id}">${item.nama_sub_kriteria} (Nilai: ${item.nilai})</option>`;
                });
            });
    } else {
        subKriteriaSelect.innerHTML = '<option value="">-- Pilih Kriteria Dulu --</option>';
    }
});
</script>
@endsection
