@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Pemenuhan CPL-CPMK-MK</h2>
    <form action="{{ route('pemenuhan.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="cpl_id" class="form-label">CPL Prodi</label>
            <select name="cpl_id" id="cpl_id" class="form-control" required>
                @foreach($cplList as $cpl)
                    <option value="{{ $cpl->id }}" {{ $item->cpl_id == $cpl->id ? 'selected' : '' }}>
                        {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cpmk_id" class="form-label">CPMK</label>
            <select name="cpmk_id" id="cpmk_id" class="form-control" required>
                @foreach($cpmkList as $cpmk)
                    <option value="{{ $cpmk->id }}" {{ $item->cpmk_id == $cpmk->id ? 'selected' : '' }}>
                        {{ $cpmk->kode_cpmk }} - {{ $cpmk->deskripsi_cpmk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mata_kuliah_id" class="form-label">Mata Kuliah</label>
            <select name="mata_kuliah_id" id="mata_kuliah_id" class="form-control" required>
                @foreach($mataKuliahList as $mk)
                    <option value="{{ $mk->id }}" {{ $item->mata_kuliah_id == $mk->id ? 'selected' : '' }}>
                        {{ $mk->kode_mk }} - {{ $mk->mata_kuliah }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="number" name="semester" id="semester" class="form-control" min="1" max="8" value="{{ $item->semester }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pemenuhan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
