@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Peta Pemenuhan CPL</h2>
    <a href="{{ route('pemenuhan-cpl.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">Kode CPL</th>
                    <th rowspan="2">Deskripsi CPL</th>
                    <th colspan="8" class="text-center">Semester</th>
                    <th rowspan="2" class="text-center" style="width: 150px;">Aksi</th>
                </tr>
                <tr>
                    @for ($i = 1; $i <= 8; $i++)
                        <th class="text-center">Semester {{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach($pemenuhanCPL as $cpl_id => $items)
                    <tr>
                        <td>{{ $items->first()->cpl->kode_cpl }}</td>
                        <td>{{ $items->first()->cpl->deskripsi_cpl }}</td>

                        {{-- Inisialisasi array untuk menyusun mata kuliah per semester --}}
                        @php
                            $semesterData = array_fill(1, 8, []);
                        @endphp

                        {{-- Looping untuk mengisi data per semester --}}
                        @foreach($items as $item)
                            @php
                                $semesterData[$item->semester][] = $item->mataKuliah->mata_kuliah;
                            @endphp
                        @endforeach

                        {{-- Tampilkan data sesuai semester --}}
                        @for ($i = 1; $i <= 8; $i++)
                            <td>
                                @if (!empty($semesterData[$i]))
                                    {!! implode('<br>', $semesterData[$i]) !!}
                                @endif
                            </td>
                        @endfor

                        {{-- Kolom Aksi --}}
                        <td class="text-center">
                            <a href="{{ route('pemenuhan-cpl.edit', $cpl_id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('pemenuhan-cpl.destroy', $items->first()->id) }}" method="POST" style="display:inline-block;">
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
