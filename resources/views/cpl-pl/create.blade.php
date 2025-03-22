@extends('layouts.app')

@section('content')
    <h1>Tambah Pemetaan CPL-PL</h1>
    <form action="{{ route('cpl-pl.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Kode CPL</label>
            <select name="kode_cpl" class="form-control">
                @foreach ($cpl as $item)
                    <option value="{{ $item->kode_cpl }}">{{ $item->kode_cpl }} - {{ $item->deskripsi_cpl }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Kode PL</label>
            <select name="kode_pl" class="form-control">
                @foreach ($pl as $item)
                    <option value="{{ $item->kode_pl }}">{{ $item->kode_pl }} - {{ $item->profil_lulusan }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>
@endsection
