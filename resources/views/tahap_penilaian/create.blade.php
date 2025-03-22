@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Tahap Penilaian</h2>

    <form action="{{ route('tahap_penilaian.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="penilaian_id" class="form-label">Pilih Data Penilaian</label>
            <select name="penilaian_id" class="form-control">
    <option value="">- Pilih Penilaian -</option>
    @foreach($penilaian as $p)
        <option value="{{ $p->id }}">
            {{ $p->cpl->kode_cpl ?? 'N/A' }} - 
            {{ $p->mataKuliah->mata_kuliah ?? 'N/A' }} - 
            {{ $p->cpmk->deskripsi_cpmk ?? 'N/A' }}
        </option>
    @endforeach
</select>
        </div>

                <div class="mb-3">
            <label>Tahap Penilaian</label>
            <textarea name="tahap_penilaian" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>Teknik Penilaian</label>
            <textarea name="teknik_penilaian" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>Instrumen</label>
            <textarea name="instrumen" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>Kriteria</label>
            <textarea name="kriteria" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>Bobot (%)</label>
            <input type="number" name="bobot" class="form-control" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
