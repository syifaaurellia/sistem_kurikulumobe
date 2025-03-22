@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Nilai Akhir Mata Kuliah</h2>
    @foreach($nilaiAkhir as $mk => $penilaian)
        <h4>{{ $penilaian->first()->pemetaan->mataKuliah->kode_mk }} - {{ $penilaian->first()->pemetaan->mataKuliah->mata_kuliah }}</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                    <th>Kode CPL</th>
                    <th>Deskripsi CPL</th>
                    <th>Kode CPMK</th>
                    <th>Deskripsi CPMK</th>
                    <th>Skor Maksimal</th>
                </tr>
            </thead>
            <tbody>
                @php $totalSkor = 0; @endphp
                @foreach($penilaian as $nilai)
                <tr>
                <td>{{ $nilai->pemetaan->mataKuliah->kode_mk }}</td>
                <td>{{ $nilai->pemetaan->mataKuliah->mata_kuliah }}</td>
                    <td>{{ $nilai->pemetaan->cpl->kode_cpl }}</td>
                    <td>{{ $nilai->pemetaan->cpl->deskripsi_cpl }}</td>
                    <td>{{ $nilai->pemetaan->cpmk->kode_cpmk }}</td>
                    <td>{{ $nilai->pemetaan->cpmk->deskripsi_cpmk }}</td>
                    <td>{{ $nilai->total }}</td>
                </tr>
                @php $totalSkor += $nilai->total; @endphp
                @endforeach
                <tr>
                    <td colspan="6" class="text-right"><strong>Total Skor Maksimal:</strong></td>
                    <td><strong>{{ $totalSkor }}</strong></td>
                </tr>
            </tbody>
        </table>
    @endforeach
</div>
@endsection
