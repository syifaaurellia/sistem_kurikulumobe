@extends('layouts.app')

@section('content')
    <h1>Pemetaan CPL-BK</h1>
    <a href="{{ route('cpl-bk.create') }}" class="btn btn-primary">Tambah Pemetaan</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode CPL</th>
                <th>Deskripsi CPL</th>
                <th>Kode BK</th>
                <th>Deskripsi BK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cplBk as $item)
                <tr>
                    <td>{{ $item->cplProdi->kode_cpl }}</td>
                    <td>{{ $item->cplProdi->deskripsi_cpl }}</td>
                    <td>{{ $item->bk->kode }}</td>
                    <td>{{ $item->bk->bahan_kajian }}</td>
                    <td>
                        <a href="{{ route('cpl-bk.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('cpl-bk.destroy', $item->id) }}" method="POST" style="display:inline;">
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
