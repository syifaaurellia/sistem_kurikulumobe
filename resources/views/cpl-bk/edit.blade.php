@extends('layouts.app')

@section('content')
    <h1>Edit CPL-BK</h1>
    <form action="{{ route('cpl-bk.update', $cplBk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kode_cpl">Kode CPL:</label>
            <select name="kode_cpl" id="kode_cpl" class="form-control" required>
                @foreach ($cplProdi as $cpl)
                    <option value="{{ $cpl->kode_cpl }}" 
                        {{ $cplBk->kode_cpl == $cpl->kode_cpl ? 'selected' : '' }}>
                        {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="kode">Kode BK:</label>
            <select name="kode" id="kode" class="form-control" required>
                @foreach ($bahanKajian as $bk)
                    <option value="{{ $bk->kode }}" 
                        {{ $cplBk->kode == $bk->kode ? 'selected' : '' }}>
                        {{ $bk->kode }} - {{ $bk->bahan_kajian }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
@endsection
