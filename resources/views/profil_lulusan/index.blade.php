@extends('layouts.app')

@section('title', 'Profil Lulusan')

@section('content')
<div class="container">
    <h1 class="mt-4">Profil Lulusan</h1>

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
                <th>Kode PL</th>
                <th>Profil Lulusan</th>
                <th>Profesi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->kode_pl }}</td>
                <td>{{ $item->profil_lulusan }}</td>
                <td>{{ $item->profesi }}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editData('{{ $item->id }}', '{{ $item->kode_pl }}', '{{ $item->profil_lulusan }}', '{{ $item->profesi }}')">Edit</button>
                    <form action="{{ route('profil-lulusan.destroy', $item->id) }}" method="POST" style="display:inline;">
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
                        <label>Kode PL</label>
                        <input type="text" class="form-control" name="kode_pl" id="kode_pl" required>
                    </div>
                    <div class="form-group">
                        <label>Profil Lulusan</label>
                        <input type="text" class="form-control" name="profil_lulusan" id="profil_lulusan" required>
                    </div>
                    <div class="form-group">
                        <label>Profesi</label>
                        <input type="text" class="form-control" name="profesi" id="profesi" required>
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
        $('#formData').attr('action', '{{ route("profil-lulusan.store") }}');
        $('#id').val('');
        $('#kode_pl').val('');
        $('#profil_lulusan').val('');
        $('#profesi').val('');
        $('#modalForm').modal('show');
    }

    function editData(id, kode_pl, profil_lulusan, profesi) {
        $('#formData').attr('action', '/profil-lulusan/' + id);
        $('#formData').append('<input type="hidden" name="_method" value="PUT">');
        $('#id').val(id);
        $('#kode_pl').val(kode_pl);
        $('#profil_lulusan').val(profil_lulusan);
        $('#profesi').val(profesi);
        $('#modalForm').modal('show');
    }
</script>
@endsection
