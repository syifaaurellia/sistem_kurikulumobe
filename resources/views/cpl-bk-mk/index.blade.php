@extends('layouts.app')

@section('content')
    <h1>Pemetaan CPL-BK-MK</h1>
    <a href="{{ route('cpl-bk-mk.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode CPL</th>
            <th>Deskripsi CPL</th>
            <th>Kode BK</th>
            <th>Bahan Kajian</th>
            <th>Kode MK</th>
            <th>Mata Kuliah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->kode_cpl }}</td>
                <td>{{ $item->cpl->deskripsi_cpl ?? '-' }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->bk->bahan_kajian ?? '-' }}</td>
                <td>{{ $item->kode_mk }}</td>
                <td>{{ $item->mk->mata_kuliah ?? '-' }}</td>
                <td>
                    <a href="{{ route('cpl-bk-mk.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('cpl-bk-mk.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
