@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pemetaan CPL - MK - CPMK</h2>

    <form action="{{ route('pemetaan.update', $pemetaanData->first()->mata_kuliah_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pilih Mata Kuliah -->
        <div class="mb-3">
            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
            <select class="form-control" name="mata_kuliah_id" id="mata_kuliah">
                @foreach ($mataKuliah as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $pemetaanData->first()->mata_kuliah_id ? 'selected' : '' }}>
                        {{ $item->kode_mk }} - {{ $item->mata_kuliah }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- CPL Container -->
        <div id="cpl-container">
            <h4>Daftar CPL</h4>

            @foreach ($pemetaanData->groupBy('cpl_id') as $cpl_id => $group)
                <div class="cpl-group border p-3 mb-3">
                    <label>CPL</label>
                    <select class="form-control mb-2" name="cpl[{{ $loop->index }}][id]">
                        @foreach ($cpl as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $cpl_id ? 'selected' : '' }}>
                                {{ $item->kode_cpl }} - {{ $item->deskripsi_cpl }}
                            </option>
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-danger btn-sm remove-cpl">Hapus CPL</button>

                    <div class="mt-3">
                        <h5>Daftar CPMK</h5>
                        <div class="cpmk-container">
                            @foreach ($group as $pemetaan)
                                <div class="border p-2 mb-2">
                                    <label>CPMK</label>
                                    <select class="form-control mb-2" name="cpl[{{ $loop->parent->index }}][cpmk][{{ $loop->index }}][id]">
                                        @foreach ($cpmk as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $pemetaan->cpmk_id ? 'selected' : '' }}>
                                                {{ $item->kode_cpmk }} - {{ $item->deskripsi_cpmk }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-danger btn-sm remove-cpmk">Hapus CPMK</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary add-cpmk">Tambah CPMK</button>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-primary mb-3" id="add-cpl">Tambah CPL</button>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const cplContainer = document.getElementById("cpl-container");

    document.getElementById("add-cpl").addEventListener("click", function() {
        let cplIndex = document.querySelectorAll(".cpl-group").length;
        let cplDiv = document.createElement("div");
        cplDiv.classList.add("cpl-group", "border", "p-3", "mb-3");
        cplDiv.innerHTML = `
            <label>CPL</label>
            <select class="form-control mb-2" name="cpl[${cplIndex}][id]">
                @foreach ($cpl as $item)
                    <option value="{{ $item->id }}">{{ $item->kode_cpl }} - {{ $item->deskripsi_cpl }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-danger btn-sm remove-cpl">Hapus CPL</button>
            <div class="mt-3">
                <h5>Daftar CPMK</h5>
                <div class="cpmk-container"></div>
                <button type="button" class="btn btn-secondary add-cpmk">Tambah CPMK</button>
            </div>
        `;
        cplContainer.appendChild(cplDiv);

        cplDiv.querySelector(".remove-cpl").addEventListener("click", function() {
            cplDiv.remove();
        });

        cplDiv.querySelector(".add-cpmk").addEventListener("click", function() {
            let cpmkContainer = cplDiv.querySelector(".cpmk-container");
            let cpmkDiv = document.createElement("div");
            cpmkDiv.classList.add("border", "p-2", "mb-2");
            cpmkDiv.innerHTML = `<select class="form-control mb-2" name="cpmk[]">@foreach ($cpmk as $item)<option value="{{ $item->id }}">{{ $item->kode_cpmk }}</option>@endforeach</select>`;
            cpmkContainer.appendChild(cpmkDiv);
        });
    });
});
</script>
@endsection
