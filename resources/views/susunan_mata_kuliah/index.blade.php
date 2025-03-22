@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Susunan Mata Kuliah</h2>
    <form action="{{ route('susunan_mata_kuliah.store') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester 1</th>
                    <th>Semester 2</th>
                    <th>Semester 3</th>
                    <th>Semester 4</th>
                    <th>Semester 5</th>
                    <th>Semester 6</th>
                    <th>Semester 7</th>
                    <th>Semester 8</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mataKuliah as $mk)
                @php
                    $susunan = $susunanMataKuliah->where('mata_kuliah_id', $mk->id)->first();
                @endphp
                <tr>
                    <td>{{ $mk->kode_mk }}</td>
                    <td>{{ $mk->mata_kuliah }}</td>
                    <td>{{ $mk->sks }}</td>

                    <!-- Input Hidden untuk mengirim ID mata kuliah -->
                    <input type="hidden" name="mata_kuliah_id[]" value="{{ $mk->id }}">

                    <!-- Checkbox Semester -->
                    <td><input type="checkbox" name="semester_1[{{ $mk->id }}]" value="1" {{ $susunan && $susunan->semester_1 ? 'checked' : '' }}></td>
                    <td><input type="checkbox" name="semester_2[{{ $mk->id }}]" value="1" {{ $susunan && $susunan->semester_2 ? 'checked' : '' }}></td>
                    <td><input type="checkbox" name="semester_3[{{ $mk->id }}]" value="1" {{ $susunan && $susunan->semester_3 ? 'checked' : '' }}></td>
                    <td><input type="checkbox" name="semester_4[{{ $mk->id }}]" value="1" {{ $susunan && $susunan->semester_4 ? 'checked' : '' }}></td>
                    <td><input type="checkbox" name="semester_5[{{ $mk->id }}]" value="1" {{ $susunan && $susunan->semester_5 ? 'checked' : '' }}></td>
                    <td><input type="checkbox" name="semester_6[{{ $mk->id }}]" value="1" {{ $susunan && $susunan->semester_6 ? 'checked' : '' }}></td>
                    <td><input type="checkbox" name="semester_7[{{ $mk->id }}]" value="1" {{ $susunan && $susunan->semester_7 ? 'checked' : '' }}></td>
                    <td><input type="checkbox" name="semester_8[{{ $mk->id }}]" value="1" {{ $susunan && $susunan->semester_8 ? 'checked' : '' }}></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
