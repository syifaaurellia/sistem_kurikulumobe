@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Organisasi Mata Kuliah</h3>
    <form action="{{ route('organisasi.store') }}" method="POST">
        @csrf

        <select name="semester" class="form-control" required>
            <option value="">-- Pilih Semester --</option>
            @for ($i = 1; $i <= 8; $i++)
                <option value="{{ $i }}">Semester {{ $i }}</option>
            @endfor
        </select>
        
        <div class="form-group">
            <label>Mata Kuliah Wajib</label><br>
            @foreach($mataKuliah as $mk)
                <input type="checkbox" name="mk_wajib[]" value="{{ $mk->id }}"> 
                {{ $mk->mata_kuliah }} ({{ $mk->sks }} SKS) <br>
            @endforeach
        </div>

        <div class="mb-3">
            <label>MK Pilihan</label>
            <select name="mk_pilihan" class="form-control">
                <option value="">-- Pilih --</option>
                @foreach($mataKuliah as $mk)
                    <option value="{{ $mk->id }}">{{ $mk->mata_kuliah }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>MKWU</label>
            <select name="mkwu" class="form-control">
                <option value="">-- Pilih --</option>
                @foreach($mataKuliah as $mk)
                    <option value="{{ $mk->id }}">{{ $mk->mata_kuliah }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('organisasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
