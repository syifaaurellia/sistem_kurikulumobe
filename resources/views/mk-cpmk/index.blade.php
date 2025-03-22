@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pemetaan MK - CPMK</h2>
    <a href="{{ route('mk-cpmk.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>Kode CPMK</th>
                <th>Deskripsi CPMK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mkCpmks as $mkCpmk)
            <tr>
                <td>{{ $mkCpmk->kode_mk }}</td>
                <td>{{ $mkCpmk->mata_kuliah }}</td>
                <td>{{ $mkCpmk->kode_cpmk }}</td>
                <td>{{ $mkCpmk->deskripsi_cpmk }}</td>
                <td>
                    <a href="{{ route('mk-cpmk.edit', $mkCpmk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('mk-cpmk.destroy', $mkCpmk->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
