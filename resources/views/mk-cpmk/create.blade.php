@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data MK - CPMK</h2>

    <form action="{{ route('mk-cpmk.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Kode Mata Kuliah</label>
            <select name="kode_mk" class="form-control">
                @foreach($mataKuliahs as $mk)
                    <option value="{{ $mk->kode_mk }}">{{ $mk->kode_mk }} - {{ $mk->mata_kuliah }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Kode CPMK</label>
            <select name="kode_cpmk" class="form-control">
                @foreach($cpmks as $cpmk)
                    <option value="{{ $cpmk->kode_cpmk }}">{{ $cpmk->kode_cpmk }} - {{ $cpmk->deskripsi_cpmk }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('mk-cpmk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
