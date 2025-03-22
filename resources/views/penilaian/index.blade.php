@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Metode Penilaian</h2>
    <a href="{{ route('penilaian.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="text-center">
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
    @php
        $cplChecked = [];
    @endphp

    @foreach($penilaian as $p)
        @if(!in_array($p->cpl->id, $cplChecked))
            @php
                $cplChecked[] = $p->cpl->id;
            @endphp
            <tr>
                <td rowspan="{{ $penilaian->where('cpl_id', $p->cpl->id)->count() }}">{{ $p->cpl->kode_cpl }}</td>
                <td rowspan="{{ $penilaian->where('cpl_id', $p->cpl->id)->count() }}">{{ $p->cpl->deskripsi_cpl }}</td>
                <td>{{ $p->mataKuliah->kode_mk }}</td>
                <td>{{ $p->mataKuliah->mata_kuliah }}</td>
                <td>{{ $p->cpmk->kode_cpmk }}</td>
                <td>{{ $p->cpmk->deskripsi_cpmk }}</td>
                <td>@if($p->quiz_tugas) ✅ @endif</td>
                <td>@if($p->observasi_praktek) ✅ @endif</td>
                <td>@if($p->unjuk_kerja) ✅ @endif</td>
                <td>@if($p->uts) ✅ @endif</td>
                <td>@if($p->uas) ✅ @endif</td>
                <td>@if($p->tugas_kelompok) ✅ @endif</td>
                <td>
                    <a href="{{ route('penilaian.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('penilaian.destroy', $p->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @else
            <tr>
                <td>{{ $p->mataKuliah->kode_mk }}</td>
                <td>{{ $p->mataKuliah->mata_kuliah }}</td>
                <td>{{ $p->cpmk->kode_cpmk }}</td>
                <td>{{ $p->cpmk->deskripsi_cpmk }}</td>
                <td>@if($p->quiz_tugas) ✅ @endif</td>
                <td>@if($p->observasi_praktek) ✅ @endif</td>
                <td>@if($p->unjuk_kerja) ✅ @endif</td>
                <td>@if($p->uts) ✅ @endif</td>
                <td>@if($p->uas) ✅ @endif</td>
                <td>@if($p->tugas_kelompok) ✅ @endif</td>
                <td>
                    <a href="{{ route('penilaian.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('penilaian.destroy', $p->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endif
    @endforeach
</tbody>
        </table>
    </div>
</div>
@endsection
