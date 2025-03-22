@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Bobot Penilaian CPL-MK-CPMK</h2>
    <a href="{{ route('bobot-penilaian-cpl.create') }}" class="btn btn-primary mb-3">Tambah Bobot Penilaian CPL-MK-CPMK</a>

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
                    <th>Quiz/Tugas</th>
                    <th>Observasi (Praktek)</th>
                    <th>Unjuk Kerja (Presentasi)</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Tugas Kelompok</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rowspanCPL = [];
                    foreach ($bobotPenilaian as $bobot) {
                        $kodeCPL = $bobot->penilaian->cpl->kode_cpl ?? 'N/A';
                        if (!isset($rowspanCPL[$kodeCPL])) {
                            $rowspanCPL[$kodeCPL] = $bobotPenilaian->where('penilaian.cpl.kode_cpl', $kodeCPL)->count();
                        }
                    }
                    
                    $prevCPL = null;
                @endphp
                
                @foreach($bobotPenilaian as $bobot)
                    <tr>
                        @php
                            $kodeCPL = $bobot->penilaian->cpl->kode_cpl ?? 'N/A';
                        @endphp

                        @if ($prevCPL !== $kodeCPL)
                            <td rowspan="{{ $rowspanCPL[$kodeCPL] }}">{{ $kodeCPL }}</td>
                            <td rowspan="{{ $rowspanCPL[$kodeCPL] }}">{{ $bobot->penilaian->cpl->deskripsi_cpl ?? 'N/A' }}</td>
                            @php
                                $prevCPL = $kodeCPL;
                            @endphp
                        @endif

                        <td>{{ $bobot->penilaian->mataKuliah->kode_mk ?? 'N/A' }}</td>
                        <td>{{ $bobot->penilaian->mataKuliah->mata_kuliah ?? 'N/A' }}</td>
                        <td>{{ $bobot->penilaian->cpmk->kode_cpmk ?? 'N/A' }}</td>
                        <td>{{ $bobot->penilaian->cpmk->deskripsi_cpmk ?? 'N/A' }}</td>
                        <td>{{ $bobot->quiz_tugas ?? 0 }}</td>
                        <td>{{ $bobot->observasi_praktek ?? 0 }}</td>
                        <td>{{ $bobot->unjuk_kerja ?? 0 }}</td>
                        <td>{{ $bobot->uts ?? 0 }}</td>
                        <td>{{ $bobot->uas ?? 0 }}</td>
                        <td>{{ $bobot->tugas_kelompok ?? 0 }}</td>
                        <td>{{ $bobot->total ?? 0 }}</td>
                        <td>
                            <a href="{{ route('bobot-penilaian-cpl.edit', $bobot->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('bobot-penilaian-cpl.destroy', $bobot->id) }}" method="POST" style="display:inline-block;">
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
