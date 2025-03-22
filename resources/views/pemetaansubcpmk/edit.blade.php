@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pemetaan MK-CPMK-SubCPMK</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pemetaansubcpmk.update', $pemetaan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pilih Mata Kuliah -->
        <div class="mb-3">
            <label for="mata_kuliah_id" class="form-label">Mata Kuliah</label>
            <select id="mata_kuliah_id" name="mata_kuliah_id" class="form-control">
                @foreach($mataKuliah as $mk)
                    <option value="{{ $mk->id }}" {{ $pemetaan->mata_kuliah_id == $mk->id ? 'selected' : '' }}>
                        {{ $mk->kode_mk }} - {{ $mk->mata_kuliah }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih CPMK -->
        <div class="mb-3">
            <label for="cpmk_id" class="form-label">CPMK</label>
            <select id="cpmk_id" name="cpmk_id" class="form-control">
                @foreach($cpmk as $c)
                    <option value="{{ $c->id }}" {{ $pemetaan->cpmk_id == $c->id ? 'selected' : '' }}>
                        {{ $c->kode_cpmk }} - {{ $c->deskripsi_cpmk }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih SubCPMK -->
        <div class="mb-3">
            <label for="sub_cpmk_id" class="form-label">SubCPMK</label>
            <select id="sub_cpmk_id" name="sub_cpmk_id" class="form-control">
                @foreach($subCpmk as $s)
                    <option value="{{ $s->id }}" {{ $pemetaan->sub_cpmk_id == $s->id ? 'selected' : '' }}>
                        {{ $s->kode_sub_cpmk }} - {{ $s->uraian_sub_cpmk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
