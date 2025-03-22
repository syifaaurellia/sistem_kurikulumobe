@extends('layouts.app')

@section('content')
    <h1>Pemetaan CPL-PL</h1>
    <a href="{{ route('cpl-pl.create') }}" class="btn btn-primary">Tambah Pemetaan</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode CPL</th>
                <th>Deskripsi CPL</th>
                <th>Kode PL</th>
                <th>Deskripsi PL</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cplPl as $item)
                <tr>
                    <td>{{ $item->cplProdi->kode_cpl }}</td>
                    <td>{{ $item->cplProdi->deskripsi_cpl }}</td>
                    <td>{{ $item->pl->kode_pl }}</td>
                    <td>{{ $item->pl->profil_lulusan }}</td>
                    <td>
                        <a href="{{ route('cpl-pl.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('cpl-pl.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus relasi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
