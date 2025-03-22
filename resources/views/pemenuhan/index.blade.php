@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pemenuhan CPL-CPMK-MK</h2>
    <a href="{{ route('pemenuhan.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-sm" style="font-size: 14px;">
            <tr>
                <th>Kode CPL</th>
                <th>Deskripsi CPL</th>
                <th>Kode CPMK</th>
                <th>Deskripsi CPMK</th>
                @for ($i = 1; $i <= 8; $i++)
                    <th>Semester {{ $i }}</th>
                @endfor
                <th>Aksi</th>
            </tr>
            <tbody>
                @php $currentCPL = null; @endphp

                @foreach ($data as $item)
                <tr>
                    {{-- Tampilkan CPL hanya jika berbeda dari sebelumnya --}}
                    @if ($currentCPL != $item->cpl->kode_cpl)
                        @php
                            // Hitung rowspan untuk CPL
                            $rowspan = $data->where('cpl.kode_cpl', $item->cpl->kode_cpl)->count();
                            $currentCPL = $item->cpl->kode_cpl;
                        @endphp
                        <td rowspan="{{ $rowspan }}">{{ $item->cpl->kode_cpl }}</td>
                        <td rowspan="{{ $rowspan }}">{{ $item->cpl->deskripsi_cpl }}</td>
                    @endif

                    {{-- CPMK --}}
                    <td>{{ $item->cpmk->kode_cpmk }}</td>
                    <td>{{ $item->cpmk->deskripsi_cpmk }}</td>

                    {{-- Semester & Mata Kuliah --}}
                    @for ($i = 1; $i <= 8; $i++)
                        <td>
                            @if ($item->semester == $i)
                                <strong>{{ $item->mataKuliah->kode_mk }}</strong><br>
                                {{ $item->mataKuliah->mata_kuliah }}
                            @endif
                        </td>
                    @endfor

                    <td>
                        <a href="{{ route('pemenuhan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pemenuhan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
