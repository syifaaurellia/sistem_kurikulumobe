@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pemetaan MK - CPMK - Sub CPMK</h2>

    <form action="{{ route('pemetaansubcpmk.update', $pemetaan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pilih Mata Kuliah -->
        <div class="mb-3">
            <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
            <select class="form-control" name="mata_kuliah_id" id="mata_kuliah">
                @foreach ($mataKuliah as $item)
                    <option value="{{ $item->id }}" {{ $pemetaan->mata_kuliah_id == $item->id ? 'selected' : '' }}>
                        {{ $item->kode_mk }} - {{ $item->nama_mata_kuliah }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih CPMK -->
        <div class="mb-3">
            <label for="cpmk" class="form-label">CPMK</label>
            <select class="form-control" name="cpmk_id" id="cpmk">
                @foreach ($cpmk as $item)
                    <option value="{{ $item->id }}" {{ $pemetaan->cpmk_id == $item->id ? 'selected' : '' }}>
                        {{ $item->kode_cpmk }} - {{ $item->deskripsi_cpmk }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Sub CPMK -->
        <div class="mb-3">
            <label for="sub_cpmk" class="form-label">Sub CPMK</label>
            <select class="form-control" name="sub_cpmk_id" id="sub_cpmk">
                @foreach ($subCpmk as $item)
                    <option value="{{ $item->id }}" {{ $pemetaan->sub_cpmk_id == $item->id ? 'selected' : '' }}>
                        {{ $item->kode_sub_cpmk }} - {{ $item->uraian_sub_cpmk }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
