@extends('layouts.app')

@section('content')
    <h1>Edit CPL-BK-MK</h1>
    <form action="{{ route('cpl-bk-mk.update', $cplBkMk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kode_cpl">Kode CPL:</label>
            <select name="kode_cpl" id="kode_cpl" class="form-control" required>
                @foreach ($cplProdi as $cpl)
                    <option value="{{ $cpl->kode_cpl }}" 
                        {{ $cplBkMk->kode_cpl == $cpl->kode_cpl ? 'selected' : '' }}>
                        {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="kode_bk">Kode BK:</label>
            <select name="kode_bk" id="kode_bk" class="form-control" required>
                @foreach ($bahanKajian as $bk)
                    <option value="{{ $bk->kode }}" 
                        {{ $cplBkMk->kode_bk == $bk->kode ? 'selected' : '' }}>
                        {{ $bk->kode }} - {{ $bk->bahan_kajian }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="kode_mk">Kode MK:</label>
            <select name="kode_mk" id="kode_mk" class="form-control" required>
                @foreach ($mataKuliah as $mk)
                    <option value="{{ $mk->kode_mk }}" 
                        {{ $cplBkMk->kode_mk == $mk->kode_mk ? 'selected' : '' }}>
                        {{ $mk->kode_mk }} - {{ $mk->mata_kuliah }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
@endsection
