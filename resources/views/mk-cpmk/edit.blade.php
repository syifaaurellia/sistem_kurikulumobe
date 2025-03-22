@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data MK - CPMK</h2>

    <form action="{{ route('mk-cpmk.update', $mkCpmk->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Kode Mata Kuliah</label>
            <select name="kode_mk" class="form-control">
                @foreach($mataKuliahs as $mk)
                    <option value="{{ $mk->kode_mk }}" {{ $mkCpmk->kode_mk == $mk->kode_mk ? 'selected' : '' }}>
                        {{ $mk->kode_mk }} - {{ $mk->mata_kuliah }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Kode CPMK</label>
            <select name="kode_cpmk" class="form-control">
                @foreach($cpmks as $cpmk)
                    <option value="{{ $cpmk->kode_cpmk }}" {{ $mkCpmk->kode_cpmk == $cpmk->kode_cpmk ? 'selected' : '' }}>
                        {{ $cpmk->kode_cpmk }} - {{ $cpmk->deskripsi_cpmk }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('mk-cpmk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
