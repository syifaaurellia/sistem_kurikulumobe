@extends('layouts.app')

@section('content')
    <h1>Edit Pemetaan CPL-PL</h1>
    <form action="{{ route('cpl-pl.update', $cplPl->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="kode_cpl">Kode CPL:</label>
            <select name="kode_cpl" id="kode_cpl" class="form-control" required>
                @foreach ($cplProdi as $cpl)
                    <option value="{{ $cpl->kode_cpl }}" 
                        {{ $cplPl->kode_cpl == $cpl->kode_cpl ? 'selected' : '' }}>
                        {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="kode_pl">Kode PL:</label>
            <select name="kode_pl" id="kode_pl" class="form-control" required>
                @foreach ($profilLulusan as $pl)
                    <option value="{{ $pl->kode_pl }}" 
                        {{ $cplPl->kode_pl == $pl->kode_pl ? 'selected' : '' }}>
                        {{ $pl->kode_pl }} - {{ $pl->profil_lulusan }}
                    </option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
@endsection
