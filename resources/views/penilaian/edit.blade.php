@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Penilaian</h3>
                    <div class="card-tools">
                        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('penilaian.update', $penilaian->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Alternatif</label>
                            <input type="text" class="form-control" 
                                   value="{{ $penilaian->alternatif->kode_alternatif }} - {{ $penilaian->alternatif->nama_supplier }}" 
                                   readonly>
                        </div>

                        <div class="form-group">
                            <label>Kriteria</label>
                            <input type="text" class="form-control" 
                                   value="{{ $penilaian->kriteria->kode_kriteria }} - {{ $penilaian->kriteria->nama_kriteria }}" 
                                   readonly>
                        </div>

                        <div class="form-group">
                            <label for="sub_kriteria_id">Pilih Sub Kriteria / Nilai <span class="text-danger">*</span></label>
                            <select name="sub_kriteria_id" id="sub_kriteria_id" 
                                    class="form-control @error('sub_kriteria_id') is-invalid @enderror">
                                @foreach($subKriteria as $sub)
                                    <option value="{{ $sub->id }}" {{ $penilaian->sub_kriteria_id == $sub->id ? 'selected' : '' }}>
                                        {{ $sub->nama_sub_kriteria }} (Nilai: {{ $sub->nilai }})
                                    </option>
                                @endforeach
                            </select>
                            @error('sub_kriteria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
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
@endsection
