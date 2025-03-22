@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pemetaan MK-CPMK-SubCPMK</h1>
    <a href="{{ route('pemetaansubcpmk.create') }}" class="btn btn-primary">Tambah Pemetaan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>Kode CPMK</th>
                <th>Deskripsi CPMK</th>
                <th>Kode Sub CPMK</th>
                <th>Uraian Sub CPMK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $currentMK = null;
                $currentCPMK = null;
            @endphp

            @foreach ($pemetaan as $data)
                @php
                    $rowspanMK = $pemetaan->where('mata_kuliah_id', $data->mata_kuliah_id)->count();
                    $rowspanCPMK = $pemetaan->where('cpmk_id', $data->cpmk_id)->count();
                @endphp

                <tr>
                    <!-- Kolom Mata Kuliah -->
                    @if ($currentMK !== $data->mata_kuliah_id)
                        <td rowspan="{{ $rowspanMK }}">{{ $data->mataKuliah->kode_mk }}</td>
                        <td rowspan="{{ $rowspanMK }}">{{ $data->mataKuliah->mata_kuliah }}</td>
                        @php $currentMK = $data->mata_kuliah_id; @endphp
                    @endif

                    <!-- Kolom CPMK -->
                    @if ($currentCPMK !== $data->cpmk_id)
                        <td rowspan="{{ $rowspanCPMK }}">{{ $data->cpmk->kode_cpmk }}</td>
                        <td rowspan="{{ $rowspanCPMK }}">{{ $data->cpmk->deskripsi_cpmk }}</td>
                        @php $currentCPMK = $data->cpmk_id; @endphp
                    @endif

                    <!-- Kolom SubCPMK -->
                    <td>{{ $data->subCpmk->kode_sub_cpmk }}</td>
                    <td>{{ $data->subCpmk->uraian_sub_cpmk }}</td>

                    <!-- Kolom Aksi (muncul setiap baris pemetaan) -->
                    <td>
                        <a href="{{ route('pemetaansubcpmk.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pemetaansubcpmk.destroy', $data->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
