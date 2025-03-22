@extends('layouts.app')

@section('content')
    <h1>Edit CPL-MK</h1>
    <form action="{{ route('cpl-mk.update', $cplMk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kode_cpl">Kode CPL:</label>
            <select name="kode_cpl" id="kode_cpl" class="form-control" required>
                @foreach ($cplProdi as $cpl)
                    <option value="{{ $cpl->kode_cpl }}" 
                        {{ $cplMk->kode_cpl == $cpl->kode_cpl ? 'selected' : '' }}>
                        {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="kode_mk">Kode MK:</label>
            <select name="kode_mk" id="kode_mk" class="form-control" required>
                @foreach ($mataKuliah as $mk)
                    <option value="{{ $mk->kode_mk }}" 
                        {{ $cplMk->kode_mk == $mk->kode_mk ? 'selected' : '' }}>
                        {{ $mk->kode_mk }} - {{ $mk->mata_kuliah }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
@endsection
