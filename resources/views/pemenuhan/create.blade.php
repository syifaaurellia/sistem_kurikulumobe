@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pemenuhan CPL</h2>

    <form action="{{ route('pemenuhan.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="cpl" class="form-label">CPL</label>
        <select class="form-control" name="cpl_id" id="cpl">
            @foreach ($cplList as $item)
                <option value="{{ $item->id }}">{{ $item->kode_cpl }} - {{ $item->deskripsi_cpl }}</option>
            @endforeach
        </select>
    </div>

    <div id="cpmk-container">
        <h4>CPMK</h4>
    </div>

    <button type="button" class="btn btn-primary mb-3" id="add-cpmk">Tambah CPMK</button>

    <button type="submit" class="btn btn-success">Simpan</button>
</form>

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
                @foreach ($cpmkList as $item)
                    <option value="{{ $item->id }}">{{ $item->kode_cpmk }} - {{ $item->deskripsi_cpmk }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-danger btn-sm remove-cpmk">Hapus CPMK</button>

            <div class="mt-3">
                <h5>Mata Kuliah</h5>
                <div class="mata-kuliah-container"></div>
                <button type="button" class="btn btn-secondary add-mata-kuliah">Tambah Mata Kuliah</button>
            </div>
        `;

        cpmkContainer.appendChild(cpmkDiv);

        // Event listener untuk hapus CPMK
        cpmkDiv.querySelector(".remove-cpmk").addEventListener("click", function() {
            cpmkDiv.remove();
        });

        // Event listener untuk tambah Mata Kuliah dalam CPMK
        cpmkDiv.querySelector(".add-mata-kuliah").addEventListener("click", function() {
            let mkContainer = cpmkDiv.querySelector(".mata-kuliah-container");
            let mkIndex = mkContainer.children.length;

            let mkDiv = document.createElement("div");
            mkDiv.classList.add("border", "p-2", "mb-2");
            mkDiv.innerHTML = `
                <label>Mata Kuliah</label>
                <select class="form-control mb-2" name="cpmk[${cpmkIndex}][mata_kuliah][${mkIndex}][id]">
                    @foreach ($mataKuliahList as $item)
                        <option value="{{ $item->id }}">{{ $item->kode_mk }} - {{ $item->mata_kuliah }}</option>
                    @endforeach
                </select>

                <label>Semester</label>
                <select class="form-control mb-2" name="cpmk[${cpmkIndex}][mata_kuliah][${mkIndex}][semester]">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}">Semester {{ $i }}</option>
                    @endfor
                </select>

                <button type="button" class="btn btn-danger btn-sm remove-mk">Hapus Mata Kuliah</button>
            `;

            mkContainer.appendChild(mkDiv);

            // Event listener untuk hapus Mata Kuliah
            mkDiv.querySelector(".remove-mk").addEventListener("click", function() {
                mkDiv.remove();
            });
        });
    });
});
</script>
@endsection
