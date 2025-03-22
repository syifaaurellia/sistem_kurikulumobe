@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Organisasi Mata Kuliah</h2>
    
    <form action="{{ route('organisasi.update', $organisasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Semester -->
        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="text" name="semester" id="semester" class="form-control" value="{{ $organisasi->semester }}" required>
        </div>

        <!-- Mata Kuliah Wajib -->
        <div class="mb-3">
            <label class="form-label">Mata Kuliah Wajib</label>
            <div class="row">
                @foreach($mataKuliah as $mk)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="mk_wajib[]" value="{{ $mk->id }}" 
                                {{ in_array($mk->id, $organisasi->mkWajib->pluck('mata_kuliah_id')->toArray()) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $mk->mata_kuliah }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Mata Kuliah Pilihan -->
        <div class="mb-3">
            <label for="mk_pilihan" class="form-label">Mata Kuliah Pilihan</label>
            <select name="mk_pilihan" id="mk_pilihan" class="form-control">
                <option value="">Pilih Mata Kuliah</option>
                @foreach($mataKuliah as $mk)
                    <option value="{{ $mk->id }}" {{ optional($organisasi->mkPilihan->first())->mata_kuliah_id == $mk->id ? 'selected' : '' }}>
                        {{ $mk->mata_kuliah }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- MKWU -->
        <div class="mb-3">
            <label for="mkwu" class="form-label">Mata Kuliah Wajib Universitas</label>
            <select name="mkwu" id="mkwu" class="form-control">
                <option value="">Pilih Mata Kuliah</option>
                @foreach($mataKuliah as $mk)
                    <option value="{{ $mk->id }}" {{ optional($organisasi->mkwu->first())->mata_kuliah_id == $mk->id ? 'selected' : '' }}>
                        {{ $mk->mata_kuliah }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
