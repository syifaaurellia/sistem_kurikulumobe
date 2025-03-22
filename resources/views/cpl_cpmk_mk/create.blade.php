@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Relasi CPL - CPMK - MK</h2>
    <form action="{{ route('cpl-cpmk-mk.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cpl_id" class="form-label">Pilih CPL</label>
            <select class="form-control" name="cpl_id" required>
                <option value="">-- Pilih CPL --</option>
                @foreach($cplList as $cpl)
                    <option value="{{ $cpl->id }}">{{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cpmk_id" class="form-label">Pilih CPMK</label>
            <select class="form-control" name="cpmk_id" required>
                <option value="">-- Pilih CPMK --</option>
                @foreach($cpmkList as $cpmk)
                    <option value="{{ $cpmk->id }}">{{ $cpmk->kode_cpmk }} - {{ $cpmk->deskripsi_cpmk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mk_id" class="form-label">Pilih Mata Kuliah</label>
            <select class="form-control" name="mata_kuliah_id" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach($mkList as $mk)
                    <option value="{{ $mk->id }}">{{ $mk->kode_mk }} - {{ $mk->mata_kuliah }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('cpl-cpmk-mk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
