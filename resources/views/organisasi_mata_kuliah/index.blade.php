@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Organisasi Mata Kuliah</h3>
    <a href="{{ route('organisasi.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Semester</th>
                <th>Total SKS</th>
                <th>Jumlah MK</th>
                <th>MK Wajib</th>
                <th>MK Pilihan</th>
                <th>MKWU</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $org)
            <tr>
                <td>{{ $org->semester }}</td>
                <td>{{ $org->total_sks }}</td>
                <td>{{ $org->jumlah_mk }}</td>
                <td>
                    {{ $org->mkWajib->pluck('mataKuliah.mata_kuliah')->join(', ') }}
                </td>
                <td>
                    @foreach($org->mkPilihan as $mk)
                        {{ $mk->mataKuliah->mata_kuliah }} <br>
                    @endforeach
                </td>
                <td>
                    @foreach($org->mkwu as $mk)
                        {{ $mk->mataKuliah->mata_kuliah }} <br>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('organisasi.edit', $org->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('organisasi.destroy', $org->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
