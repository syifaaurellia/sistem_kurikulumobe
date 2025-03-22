@extends('layouts.app')

@section('content')
    <h1>Pemetaan CPL-MK</h1>
    <a href="{{ route('cpl-mk.create') }}" class="btn btn-primary">Tambah Pemetaan</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode CPL</th>
                <th>Deskripsi CPL</th>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cplMk as $item)
                <tr>
                    <td>{{ $item->cplProdi->kode_cpl }}</td>
                    <td>{{ $item->cplProdi->deskripsi_cpl }}</td>
                    <td>{{ $item->mataKuliah->kode_mk }}</td>
                    <td>{{ $item->mataKuliah->mata_kuliah }}</td>
                    <td>
                        <a href="{{ route('cpl-mk.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('cpl-mk.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
