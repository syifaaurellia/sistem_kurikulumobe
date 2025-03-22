@extends('layouts.app')

@section('content')
    <h1>Tambah Pemetaan CPL-BK</h1>
    <form action="{{ route('cpl-bk.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="kode_cpl">Kode CPL:</label>
            <select name="kode_cpl" id="kode_cpl" class="form-control" required>
                @foreach ($cpl as $itemCpl)
                    <option value="{{ $itemCpl->kode_cpl }}">
                        {{ $itemCpl->kode_cpl }} - {{ $itemCpl->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="kode">Kode BK:</label>
            <select name="kode" id="kode" class="form-control" required>
                @foreach ($bk as $itemBk)
                    <option value="{{ $itemBk->kode }}">
                        {{ $itemBk->kode }} - {{ $itemBk->bahan_kajian }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </form>
@endsection
