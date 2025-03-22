@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Bobot Penilaian CPL-MK-CPMK</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bobot-penilaian-cpl.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="penilaian_id" class="form-label">Pemetaan CPL-MK-CPMK</label>
            <select name="penilaian_id" id="penilaian_id" class="form-control" style="max-width: 800px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" required>
                <option value="">-- Pilih Pemetaan --</option>
                @foreach ($penilaian as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->cpl->kode_cpl }}, 
                        {{ $item->mataKuliah->kode_mk }} - {{ $item->mataKuliah->mata_kuliah }}.,
                        {{ $item->cpmk->kode_cpmk }} - {{ $item->cpmk->deskripsi_cpmk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quiz_tugas" class="form-label">Quiz/Tugas</label>
            <input type="number" name="quiz_tugas" id="quiz_tugas" class="form-control nilai">
        </div>

        <div class="mb-3">
            <label for="observasi_praktek" class="form-label">Observasi (Praktek)</label>
            <input type="number" name="observasi_praktek" id="observasi_praktek" class="form-control nilai">
        </div>

        <div class="mb-3">
            <label for="unjuk_kerja" class="form-label">Unjuk Kerja (Presentasi)</label>
            <input type="number" name="unjuk_kerja" id="unjuk_kerja" class="form-control nilai">
        </div>

        <div class="mb-3">
            <label for="uts" class="form-label">UTS</label>
            <input type="number" name="uts" id="uts" class="form-control nilai">
        </div>

        <div class="mb-3">
            <label for="uas" class="form-label">UAS</label>
            <input type="number" name="uas" id="uas" class="form-control nilai">
        </div>

        <div class="mb-3">
            <label for="tugas_kelompok" class="form-label">Tugas Kelompok</label>
            <input type="number" name="tugas_kelompok" id="tugas_kelompok" class="form-control nilai">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('bobot-penilaian-cpl.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
