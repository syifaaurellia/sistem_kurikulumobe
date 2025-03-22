@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Bobot Penilaian MK-CPL-CPMK</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bobot-penilaian.update', $bobotPenilaian->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Pilih Pemetaan CPL-MK-CPMK --}}
        <div class="mb-3">
            <label for="id_pemetaan_cpl_mk_cpmk" class="form-label">Pemetaan CPL-MK-CPMK</label>
            <select name="id_pemetaan_cpl_mk_cpmk" id="id_pemetaan_cpl_mk_cpmk" class="form-control" required>
                <option value="">-- Pilih Pemetaan --</option>
                @foreach ($pemetaan as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $bobotPenilaian->id_pemetaan_cpl_mk_cpmk ? 'selected' : '' }}>
                        {{ $item->mataKuliah->kode_mk }},    
                        {{ $item->cpl->kode_cpl }} - {{ $item->cpl->deskripsi_cpl }}, 
                        {{ $item->cpmk->kode_cpmk }} - {{ $item->cpmk->deskripsi_cpmk }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Input nilai bobot --}}
        <div class="row">
            <div class="col-md-4">
                <label for="quiz_tugas">Quiz (%)</label>
                <input type="number" name="quiz_tugas" id="quiz_tugas" class="form-control nilai" value="{{ $bobotPenilaian->quiz_tugas }}" min="0" max="100">
            </div>

            <div class="col-md-4">
                <label for="observasi_praktek">Observasi (%)</label>
                <input type="number" name="observasi_praktek" id="observasi_praktek" class="form-control nilai" value="{{ $bobotPenilaian->observasi_praktek }}" min="0" max="100">
            </div>

            <div class="col-md-4">
                <label for="unjuk_kerja">Unjuk Kerja (%)</label>
                <input type="number" name="unjuk_kerja" id="unjuk_kerja" class="form-control nilai" value="{{ $bobotPenilaian->unjuk_kerja }}" min="0" max="100">
            </div>

            <div class="col-md-4">
                <label for="uts">UTS (%)</label>
                <input type="number" name="uts" id="uts" class="form-control nilai" value="{{ $bobotPenilaian->uts }}" min="0" max="100">
            </div>

            <div class="col-md-4">
                <label for="uas">UAS (%)</label>
                <input type="number" name="uas" id="uas" class="form-control nilai" value="{{ $bobotPenilaian->uas }}" min="0" max="100">
            </div>

            <div class="col-md-4">
                <label for="tugas_kelompok">Tugas Kelompok (%)</label>
                <input type="number" name="tugas_kelompok" id="tugas_kelompok" class="form-control nilai" value="{{ $bobotPenilaian->tugas_kelompok }}" min="0" max="100">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('bobot-penilaian.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

@endsection
