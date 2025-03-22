@extends('layouts.app')

@section('content')
    <h1>Tambah Pemetaan CPL-BK-MK</h1>
    <form action="{{ route('cpl-bk-mk.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="kode_cpl">Kode CPL:</label>
            <select name="kode_cpl" id="kode_cpl" class="form-control" required>
                @foreach ($cplProdi as $cpl)
                    <option value="{{ $cpl->kode_cpl }}">{{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="kode">Kode BK:</label>
            <select name="kode" id="kode" class="form-control" required>
                @foreach ($bahanKajian as $bk)
                    <option value="{{ $bk->kode }}">{{ $bk->kode }} - {{ $bk->bahan_kajian }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="kode_mk">Kode MK:</label>
            <select name="kode_mk" id="kode_mk" class="form-control" required>
                @foreach ($mataKuliah as $mk)
                    <option value="{{ $mk->kode_mk }}">{{ $mk->kode_mk }} - {{ $mk->mata_kuliah }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>
@endsection
