@extends('layouts.app')

@section('content')
    <h1>Tambah Pemetaan CPL-MK</h1>
    <form action="{{ route('cpl-mk.store') }}" method="POST">
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
            <label>Kode MK</label>
            <select name="kode_mk" class="form-control">
                @foreach ($mk as $item)
                    <option value="{{ $item->kode_mk }}">{{ $item->kode_mk }} - {{ $item->mata_kuliah }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>
@endsection
