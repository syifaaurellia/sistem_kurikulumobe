@extends('layouts.app')

@section('content')
    <h1>Pemetaan BK-MK</h1>
    <a href="{{ route('bk-mk.create') }}" class="btn btn-primary">Tambah Pemetaan</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Kode BK</th>
                <th>Bahan Kajian</th>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bkMk as $item)
                <tr>
                    <td>{{ $item->bk->kode }}</td>
                    <td>{{ $item->bk->bahan_kajian }}</td>
                    <td>{{ $item->mk->kode_mk }}</td>
                    <td>{{ $item->mk->mata_kuliah }}</td>
                    <td>
                        <a href="{{ route('bk-mk.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('bk-mk.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pemetaan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
