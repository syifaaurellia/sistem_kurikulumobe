@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Metode Penilaian</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penilaian.update', $penilaian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pilih CPL -->
        <div class="mb-3">
            <label for="cpl_id">Pilih CPL</label>
            <select name="cpl_id" class="form-control" required>
                <option value="">-- Pilih CPL --</option>
                @foreach($cpl as $c)
                    <option value="{{ $c->id }}" {{ $penilaian->cpl_id == $c->id ? 'selected' : '' }}>
                        {{ $c->kode_cpl }} - {{ $c->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Mata Kuliah, CPMK & Metode Penilaian -->
        <div id="mk-cpmk-container">
            <h4>Daftar Mata Kuliah, CPMK & Metode Penilaian</h4>
            <div class="mk-cpmk-group border p-3 mb-3">
                <label>Mata Kuliah</label>
                <select class="form-control mb-2" name="mk[0][id]" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach ($mataKuliah as $mk)
                        <option value="{{ $mk->id }}" {{ $penilaian->mk_id == $mk->id ? 'selected' : '' }}>
                            {{ $mk->kode_mk }} - {{ $mk->mata_kuliah }}
                        </option>
                    @endforeach
                </select>

                <label>CPMK</label>
                <select class="form-control mb-2" name="mk[0][cpmk_id]" required>
                    <option value="">-- Pilih CPMK --</option>
                    @foreach ($cpmk as $cp)
                        <option value="{{ $cp->id }}" {{ $penilaian->cpmk_id == $cp->id ? 'selected' : '' }}>
                            {{ $cp->kode_cpmk }} - {{ $cp->deskripsi_cpmk }}
                        </option>
                    @endforeach
                </select>

                <label>Metode Penilaian</label>
                <div class="mb-2">
                    @foreach(['quiz_tugas' => 'Quiz/Tugas', 'observasi_praktek' => 'Observasi (Praktek)', 'unjuk_kerja' => 'Unjuk Kerja (Presentasi)', 'uts' => 'UTS', 'uas' => 'UAS', 'tugas_kelompok' => 'Tugas Kelompok'] as $key => $label)
                        <div class="form-check">
                            <input type="checkbox" name="mk[0][metode_penilaian][]" value="{{ $key }}" class="form-check-input"
                                {{ $penilaian->$key ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $label }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Update</button>
    </form>
</div>
@endsection
