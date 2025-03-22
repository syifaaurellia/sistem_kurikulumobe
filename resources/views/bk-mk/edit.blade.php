@extends('layouts.app')

@section('content')
    <h1>Edit Pemetaan BK-MK</h1>
    <form action="{{ route('bk-mk.update', $bkMk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kode">Kode BK:</label>
            <select name="kode" id="kode" class="form-control" required>
                @foreach ($bk as $item)
                    <option value="{{ $item->kode }}" 
                        {{ $item->kode == $bkMk->kode ? 'selected' : '' }}>
                        {{ $item->kode }} - {{ $item->bahan_kajian }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="kode_mk">Kode MK:</label>
            <select name="kode_mk" id="kode_mk" class="form-control" required>
                @foreach ($mk as $item)
                    <option value="{{ $item->kode_mk }}" 
                        {{ $item->kode_mk == $bkMk->kode_mk ? 'selected' : '' }}>
                        {{ $item->kode_mk }} - {{ $item->mata_kuliah }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
@endsection
