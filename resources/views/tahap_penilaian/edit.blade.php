@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Tahap Penilaian</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tahap_penilaian.update', $tahap_penilaian->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Pilihan Data Penilaian --}}
                <div class="mb-3">
                    <label for="penilaian_id" class="form-label">Pilih Data Penilaian</label>
                    <select name="penilaian_id" class="form-control">
                        @foreach($penilaian as $data)
                            <option value="{{ $data->id }}" {{ $data->id == $tahap_penilaian->penilaian_id ? 'selected' : '' }}>
                                {{ $data->cpl->kode_cpl ?? '' }} - 
                                {{ $data->mataKuliah->mata_kuliah ?? '' }} - 
                                {{ $data->cpmk->deskripsi_cpmk ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Form Input untuk Tahap Penilaian --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tahap Penilaian</label>
                            <textarea name="tahap_penilaian" class="form-control" rows="3">{{ $tahap_penilaian->tahap_penilaian }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Teknik Penilaian</label>
                            <textarea name="teknik_penilaian" class="form-control" rows="3">{{ $tahap_penilaian->teknik_penilaian }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Instrumen</label>
                            <textarea name="instrumen" class="form-control" rows="3">{{ $tahap_penilaian->instrumen }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kriteria</label>
                            <textarea name="kriteria" class="form-control" rows="3">{{ $tahap_penilaian->kriteria }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Input Bobot --}}
                <div class="mb-3">
                    <label for="bobot" class="form-label">Bobot (%)</label>
                    <input type="number" name="bobot" class="form-control" min="0" max="100" value="{{ old('bobot', $tahap_penilaian->bobot) }}" required>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('tahap_penilaian.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
