@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pemetaan MK-CPL-CPMK</h2>
    <a href="{{ route('pemetaan.create') }}" class="btn btn-primary mb-3">Tambah Pemetaan</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>Kode CPL</th>
                <th>Deskripsi CPL</th>
                <th>Kode CPMK</th>
                <th>Deskripsi CPMK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemetaan->groupBy('mataKuliah.id') as $mkId => $groupedMK)
                @php
                    $firstMK = $groupedMK->first();
                    $totalMKRows = $groupedMK->groupBy('cpl.id')->sum(fn($cplGroup) => $cplGroup->count());
                @endphp

                <tr>
                    <td rowspan="{{ $totalMKRows }}">{{ optional($firstMK->mataKuliah)->kode_mk }}</td>
                    <td rowspan="{{ $totalMKRows }}">{{ optional($firstMK->mataKuliah)->mata_kuliah }}</td>

                    @php $firstMKRow = true; @endphp
                    @foreach($groupedMK->groupBy('cpl.id') as $cplId => $groupedCPL)
                        @php
                            $firstCPL = $groupedCPL->first();
                            $totalCPLRows = $groupedCPL->count();
                        @endphp

                        @if (!$firstMKRow) <tr> @endif
                            <td rowspan="{{ $totalCPLRows }}">{{ optional($firstCPL->cpl)->kode_cpl }}</td>
                            <td rowspan="{{ $totalCPLRows }}">{{ optional($firstCPL->cpl)->deskripsi_cpl }}</td>

                            @php $firstCPLRow = true; @endphp
                            @foreach($groupedCPL as $index => $item)
                                @if (!$firstCPLRow) <tr> @endif
                                    <td>{{ optional($item->cpmk)->kode_cpmk }}</td>
                                    <td>{{ optional($item->cpmk)->deskripsi_cpmk }}</td>

                                    @if ($firstMKRow && $index == 0)
                                        <td rowspan="{{ $totalMKRows }}">
                                            <a href="{{ route('pemetaan.edit', $firstMK->mata_kuliah_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('pemetaan.destroy', $firstMK->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    @endif
                                @if (!$firstCPLRow) </tr> @endif
                                @php $firstCPLRow = false; @endphp
                            @endforeach
                        @if (!$firstMKRow) </tr> @endif
                        @php $firstMKRow = false; @endphp
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
