@extends('layouts.app')

@section('title', 'Daftar Mata Kuliah')

@section('content')
<div class="container">
    <h1 class="mt-4">Daftar Mata Kuliah</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tombol Tambah Data -->
    <button class="btn btn-primary mb-3" onclick="openForm()">Tambah Data</button>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->kode_mk }}</td>
                <td>{{ $item->mata_kuliah }}</td>
                <td>{{ $item->sks }}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editData('{{ $item->id }}', '{{ $item->kode_mk }}', '{{ $item->mata_kuliah }}', '{{ $item->sks }}')">Edit</button>
                    <form action="{{ route('mata-kuliah.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalForm" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" id="formData">
            @csrf
            <input type="hidden" id="id" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah/Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode MK</label>
                        <input type="text" class="form-control" name="kode_mk" id="kode_mk" required>
                    </div>
                    <div class="form-group">
                        <label>Mata Kuliah</label>
                        <input type="text" class="form-control" name="mata_kuliah" id="mata_kuliah" required>
                    </div>
                    <div class="form-group">
                        <label>SKS</label>
                        <input type="number" class="form-control" name="sks" id="sks" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openForm() {
        $('#formData').attr('action', '{{ route("mata-kuliah.store") }}');
        $('#id').val('');
        $('#kode_mk').val('');
        $('#mata_kuliah').val('');
        $('#sks').val('');
        $('#modalForm').modal('show');
    }

    function editData(id, kode_mk, mata_kuliah, sks) {
        $('#formData').attr('action', '/mata-kuliah/' + id);
        $('#formData').append('<input type="hidden" name="_method" value="PUT">');
        $('#id').val(id);
        $('#kode_mk').val(kode_mk);
        $('#mata_kuliah').val(mata_kuliah);
        $('#sks').val(sks);
        $('#modalForm').modal('show');
    }
</script>
@endsection
