@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Relasi CPL - CPMK - MK</h2>
    <a href="{{ route('cpl-cpmk-mk.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode CPL</th>
                <th>Deskripsi CPL</th>
                <th>Kode CPMK</th>
                <th>Deskripsi CPMK</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($relasi as $item)
                <tr>
                    <td>{{ $item->cpl->kode_cpl }}</td>
                    <td>{{ $item->cpl->deskripsi_cpl }}</td>
                    <td>{{ $item->cpmk->kode_cpmk }}</td>
                    <td>{{ $item->cpmk->deskripsi_cpmk }}</td>
                    <td>{{ $item->mataKuliah->kode_mk }}</td>
                    <td>{{ $item->mataKuliah->mata_kuliah }}</td>
                    <td>
                        <a href="{{ route('cpl-cpmk-mk.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('cpl-cpmk-mk.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
