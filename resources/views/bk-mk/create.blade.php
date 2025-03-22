@extends('layouts.app')

@section('content')
    <h1>Tambah Pemetaan BK-MK</h1>
    <form action="{{ route('bk-mk.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Kode BK</label>
            <select name="kode" class="form-control">
                @foreach ($bk as $item)
                    <option value="{{ $item->kode }}">{{ $item->kode }} - {{ $item->bahan_kajian }}</option>
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
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection
