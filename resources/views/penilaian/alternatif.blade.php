@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Penilaian untuk: <strong>{{ $alternatif->kode_alternatif }} - {{ $alternatif->nama_supplier }}</strong>
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('penilaian.alternatif.save', $alternatif->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            Berikan penilaian untuk setiap kriteria. Pilih sub kriteria yang paling sesuai dengan kondisi supplier ini.
                        </div>

                        @foreach($kriteria as $k)
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <span class="badge badge-info">{{ $k->kode_kriteria }}</span>
                                    {{ $k->nama_kriteria }}
                                    <span class="badge badge-{{ $k->jenis_kriteria == 'benefit' ? 'success' : 'warning' }}">
                                        {{ ucfirst($k->jenis_kriteria) }}
                                    </span>
                                    <span class="text-muted">(Bobot: {{ $k->bobot }}%)</span>
                                </h5>
                                @if($k->keterangan)
                                <small class="text-muted">{{ $k->keterangan }}</small>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    @php
                                        $selectedPenilaian = $penilaian->get($k->id);
                                    @endphp
                                    @foreach($k->subKriteria as $sub)
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" 
                                               id="sub_{{ $k->id }}_{{ $sub->id }}" 
                                               name="penilaian[{{ $k->id }}]" 
                                               value="{{ $sub->id }}"
                                               class="custom-control-input @error('penilaian.'.$k->id) is-invalid @enderror"
                                               {{ $selectedPenilaian && $selectedPenilaian->sub_kriteria_id == $sub->id ? 'checked' : '' }}
                                               required>
                                        <label class="custom-control-label" for="sub_{{ $k->id }}_{{ $sub->id }}">
                                            <strong>{{ $sub->nama_sub_kriteria }}</strong> 
                                            <span class="badge badge-primary">Nilai: {{ $sub->nilai }}</span>
                                            @if($sub->keterangan)
                                                <br><small class="text-muted">{{ $sub->keterangan }}</small>
                                            @endif
                                        </label>
                                    </div>
                                    @endforeach
                                    @error('penilaian.'.$k->id)
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> Simpan Semua Penilaian
                        </button>
                        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
