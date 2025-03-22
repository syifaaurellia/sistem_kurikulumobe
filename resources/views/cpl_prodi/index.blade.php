@extends('layouts.app')

@section('title', 'CPL Prodi')

@section('content')
<div class="container">
    <h1 class="mt-4">CPL Prodi</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tombol Tambah Data di Atas Tabel -->
    <button class="btn btn-primary mb-3" onclick="openForm()">Tambah Data</button>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode CPL</th>
                <th>Deskripsi CPL</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->kode_cpl }}</td>
                <td>{{ $item->deskripsi_cpl }}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editData('{{ $item->id }}', '{{ $item->kode_cpl }}', '{{ $item->deskripsi_cpl }}')">Edit</button>
                    <form action="{{ route('cpl-prodi.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
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
                        <label>Kode CPL</label>
                        <input type="text" class="form-control" name="kode_cpl" id="kode_cpl" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi CPL</label>
                        <textarea class="form-control" name="deskripsi_cpl" id="deskripsi_cpl" required></textarea>
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
        $('#formData').attr('action', '{{ route("cpl-prodi.store") }}');
        $('#id').val('');
        $('#kode_cpl').val('');
        $('#deskripsi_cpl').val('');
        $('#modalForm').modal('show');
    }

    function editData(id, kode_cpl, deskripsi_cpl) {
        $('#formData').attr('action', '/cpl-prodi/' + id);
        $('#formData').append('<input type="hidden" name="_method" value="PUT">');
        $('#id').val(id);
        $('#kode_cpl').val(kode_cpl);
        $('#deskripsi_cpl').val(deskripsi_cpl);
        $('#modalForm').modal('show');
    }
</script>
@endsection
