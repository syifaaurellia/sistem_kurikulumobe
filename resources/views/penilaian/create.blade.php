@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Metode Penilaian</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penilaian.store') }}" method="POST">
        @csrf

        <!-- Pilih CPL -->
        <div class="mb-3">
            <label for="cpl_id">Pilih CPL</label>
            <select name="cpl_id" class="form-control" required>
                <option value="">-- Pilih CPL --</option>
                @foreach($cpl as $c)
                    <option value="{{ $c->id }}">{{ $c->kode_cpl }} - {{ $c->deskripsi_cpl }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dynamic MK, CPMK, & Metode Penilaian -->
        <div id="mk-cpmk-container">
            <h4>Daftar Mata Kuliah, CPMK & Metode Penilaian</h4>
        </div>
        <button type="button" class="btn btn-success mt-2" id="add-mk-cpmk">+ Tambah MK & CPMK</button>

        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("mk-cpmk-container");
    document.getElementById("add-mk-cpmk").addEventListener("click", function() {
        let index = document.querySelectorAll(".mk-cpmk-group").length;

        let div = document.createElement("div");
        div.classList.add("mk-cpmk-group", "border", "p-3", "mb-3");
        div.innerHTML = `
            <label>Mata Kuliah</label>
            <select class="form-control mb-2" name="mk[${index}][id]" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach ($mataKuliah as $mk)
                    <option value="{{ $mk->id }}">{{ $mk->kode_mk }} - {{ $mk->mata_kuliah }}</option>
                @endforeach
            </select>

            <label>CPMK</label>
            <select class="form-control mb-2" name="mk[${index}][cpmk_id]" required>
                <option value="">-- Pilih CPMK --</option>
                @foreach ($cpmk as $cp)
                    <option value="{{ $cp->id }}">{{ $cp->kode_cpmk }} - {{ $cp->deskripsi_cpmk }}</option>
                @endforeach
            </select>

            <label>Metode Penilaian</label>
            <div class="mb-2">
                @foreach(['quiz_tugas' => 'Quiz/Tugas', 'observasi_praktek' => 'Observasi (Praktek)', 'unjuk_kerja' => 'Unjuk Kerja (Presentasi)', 'uts' => 'UTS', 'uas' => 'UAS', 'tugas_kelompok' => 'Tugas Kelompok'] as $key => $label)
                    <div class="form-check">
                        <input type="checkbox" name="mk[${index}][metode_penilaian][]" value="{{ $key }}" class="form-check-input">
                        <label class="form-check-label">{{ $label }}</label>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-danger btn-sm remove-mk-cpmk">Hapus</button>
        `;

        container.appendChild(div);

        div.querySelector(".remove-mk-cpmk").addEventListener("click", function() {
            div.remove();
        });
    });
});
</script>
@endsection
