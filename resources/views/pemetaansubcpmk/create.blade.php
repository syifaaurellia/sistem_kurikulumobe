@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pemetaan MK-CPMK-SubCPMK</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pemetaansubcpmk.store') }}" method="POST">
        @csrf

        <!-- Pilih Mata Kuliah -->
        <div class="mb-3">
            <label for="mata_kuliah_id" class="form-label">Mata Kuliah</label>
            <select id="mata_kuliah_id" name="mata_kuliah_id" class="form-control">
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach($mataKuliah as $mk)
                    <option value="{{ $mk->id }}">{{ $mk->kode_mk }} - {{ $mk->mata_kuliah }}</option>
                @endforeach
            </select>
        </div>

        <!-- Container CPMK -->
        <div id="cpmk-container">
            <h4>Daftar CPMK</h4>
        </div>
        <button type="button" class="btn btn-success" id="add-cpmk">+ Tambah CPMK</button>

        <div class="mb-3 mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const cpmkContainer = document.getElementById("cpmk-container");
    document.getElementById("add-cpmk").addEventListener("click", function() {
        let cpmkIndex = document.querySelectorAll(".cpmk-group").length;

        let cpmkDiv = document.createElement("div");
        cpmkDiv.classList.add("cpmk-group", "border", "p-3", "mb-3");
        cpmkDiv.innerHTML = `
            <label>CPMK</label>
            <select class="form-control mb-2" name="cpmk[${cpmkIndex}][id]">
                <option value="">-- Pilih CPMK --</option>
                @foreach ($cpmk as $c)
                    <option value="{{ $c->id }}">{{ $c->kode_cpmk }} - {{ $c->deskripsi_cpmk }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-danger btn-sm remove-cpmk">Hapus CPMK</button>

            <div class="mt-3">
                <h5>Daftar SubCPMK</h5>
                <div class="subcpmk-container"></div>
                <button type="button" class="btn btn-secondary add-subcpmk">Tambah SubCPMK</button>
            </div>
        `;

        cpmkContainer.appendChild(cpmkDiv);

        // Event listener untuk hapus CPMK
        cpmkDiv.querySelector(".remove-cpmk").addEventListener("click", function() {
            cpmkDiv.remove();
        });

        // Event listener untuk tambah SubCPMK dalam CPMK
        cpmkDiv.querySelector(".add-subcpmk").addEventListener("click", function() {
            let subCpmkContainer = cpmkDiv.querySelector(".subcpmk-container");
            let subCpmkIndex = subCpmkContainer.children.length;

            let subCpmkDiv = document.createElement("div");
            subCpmkDiv.classList.add("border", "p-2", "mb-2");
            subCpmkDiv.innerHTML = `
                <label>SubCPMK</label>
                <select class="form-control mb-2" name="cpmk[${cpmkIndex}][sub_cpmk][${subCpmkIndex}][id]">
                    <option value="">-- Pilih SubCPMK --</option>
                    @foreach ($subCpmk as $s)
                        <option value="{{ $s->id }}">{{ $s->kode_sub_cpmk }} - {{ $s->uraian_sub_cpmk }}</option>
                    @endforeach
                </select>

                <button type="button" class="btn btn-danger btn-sm remove-subcpmk">Hapus SubCPMK</button>
            `;

            subCpmkContainer.appendChild(subCpmkDiv);

            // Event listener untuk hapus SubCPMK
            subCpmkDiv.querySelector(".remove-subcpmk").addEventListener("click", function() {
                subCpmkDiv.remove();
            });
        });
    });
});
</script>
@endsection
