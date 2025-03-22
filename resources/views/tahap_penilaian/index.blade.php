@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Tahap Penilaian</h2>
    <a href="{{ route('tahap_penilaian.create') }}" class="btn btn-primary mb-3">Tambah Tahap Penilaian</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode CPL</th>
                    <th>Deskripsi CPL</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>Kode CPMK</th>
                    <th>Deskripsi CPMK</th>
                    <th>Tahap Penilaian</th>
                    <th>Teknik Penilaian</th>
                    <th>Instrumen</th>
                    <th>Kriteria</th>
                    <th>Bobot %</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $prevCpl = null;
                @endphp
                @foreach($tahapPenilaian as $p)
                    <tr>
                        @if ($prevCpl !== ($p->cpl->kode_cpl ?? 'N/A'))
                            <td rowspan="{{ $tahapPenilaian->where('cpl.kode_cpl', $p->cpl->kode_cpl)->count() }}">
                                {{ $p->cpl->kode_cpl ?? 'N/A' }}
                            </td>
                            <td rowspan="{{ $tahapPenilaian->where('cpl.kode_cpl', $p->cpl->kode_cpl)->count() }}">
                                {{ $p->cpl->deskripsi_cpl ?? 'N/A' }}
                            </td>
                            @php
                                $prevCpl = $p->cpl->kode_cpl ?? 'N/A';
                            @endphp
                        @endif
                        <td>{{ $p->mataKuliah->kode_mk ?? 'N/A' }}</td>
                        <td>{{ $p->mataKuliah->mata_kuliah ?? 'N/A' }}</td>
                        <td>{{ $p->cpmk->kode_cpmk ?? 'N/A' }}</td>
                        <td>{{ $p->cpmk->deskripsi_cpmk ?? 'N/A' }}</td>
                        <td>{{ $p->tahap_penilaian }}</td>
                        <td>{{ $p->teknik_penilaian }}</td>
                        <td>{{ $p->instrumen }}</td>
                        <td>{{ $p->kriteria }}</td>
                        <td>{{ $p->bobot }}</td>
                        <td>
                            <a href="{{ route('tahap_penilaian.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('tahap_penilaian.destroy', $p->id) }}" method="POST" style="display:inline-block;">
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
</div>
@endsection
