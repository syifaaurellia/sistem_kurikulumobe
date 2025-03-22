@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Bobot Penilaian MK-CPL-CPMK</h2>
    <a href="{{ route('bobot-penilaian.create') }}" class="btn btn-primary mb-3">Tambah Bobot Penilaian MK-CPL-CPMK</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>Kode CPL</th>
                    <th>Deskripsi CPL</th>
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
                    $prevMk = null;
                    $prevCpl = null;
                @endphp
                @foreach($bobotPenilaian as $bobot)
                    <tr>
                        @if ($prevMk !== ($bobot->mataKuliah->kode_mk ?? 'N/A'))
                            <td rowspan="{{ $bobotPenilaian->where('mataKuliah.kode_mk', $bobot->mataKuliah->kode_mk)->count() }}">
                                {{ $bobot->mataKuliah->kode_mk ?? 'N/A' }}
                            </td>
                            <td rowspan="{{ $bobotPenilaian->where('mataKuliah.kode_mk', $bobot->mataKuliah->kode_mk)->count() }}">
                                {{ $bobot->mataKuliah->mata_kuliah ?? 'N/A' }}
                            </td>
                            @php
                                $prevMk = $bobot->mataKuliah->kode_mk ?? 'N/A';
                            @endphp
                        @endif

                        @if ($prevCpl !== ($bobot->cpl->kode_cpl ?? 'N/A'))
                            <td rowspan="{{ $bobotPenilaian->where('cpl.kode_cpl', $bobot->cpl->kode_cpl)->count() }}">
                                {{ $bobot->cpl->kode_cpl ?? 'N/A' }}
                            </td>
                            <td rowspan="{{ $bobotPenilaian->where('cpl.kode_cpl', $bobot->cpl->kode_cpl)->count() }}">
                                {{ $bobot->cpl->deskripsi_cpl ?? 'N/A' }}
                            </td>
                            @php
                                $prevCpl = $bobot->cpl->kode_cpl ?? 'N/A';
                            @endphp
                        @endif

                        <td>{{ $bobot->cpmk->kode_cpmk ?? 'N/A' }}</td>
                        <td>{{ $bobot->cpmk->deskripsi_cpmk ?? 'N/A' }}</td>
                        <td>{{ $bobot->quiz_tugas ?? 0 }}</td>
                        <td>{{ $bobot->observasi_praktek ?? 0 }}</td>
                        <td>{{ $bobot->unjuk_kerja ?? 0 }}</td>
                        <td>{{ $bobot->uts ?? 0 }}</td>
                        <td>{{ $bobot->uas ?? 0 }}</td>
                        <td>{{ $bobot->tugas_kelompok ?? 0 }}</td>
                        <td>{{ $bobot->total ?? 0 }}</td>
                        <td>
                            <a href="{{ route('bobot-penilaian.edit', $bobot->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('bobot-penilaian.destroy', $bobot->id) }}" method="POST" style="display:inline-block;">
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
