@extends('layouts.app')

@section('title', 'Bahan Kajian')

@section('content')
<div class="container">
    <h1 class="mt-4">Bahan Kajian</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tombol Tambah Data di Atas Tabel -->
    <button class="btn btn-primary mb-3" onclick="openForm()">Tambah Data</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Bahan Kajian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->bahan_kajian }}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editData('{{ $item->id }}', '{{ $item->kode }}', '{{ $item->bahan_kajian }}')">Edit</button>
                    <form action="{{ route('bahan-kajian.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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

<div class="modal fade" id="modalForm" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" id="formData">
            @csrf
            <input type="hidden" name="_method" value="POST" id="methodField">
            <input type="hidden" id="id" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" class="form-control" name="kode" id="kode" required>
                    </div>
                    <div class="form-group">
                        <label>Bahan Kajian</label>
                        <textarea class="form-control" name="bahan_kajian" id="bahan_kajian" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openForm() {
        $('#modalTitle').text('Tambah Data');
        $('#formData').attr('action', '{{ route("bahan-kajian.store") }}');
        $('#methodField').val('POST');
        $('#formData')[0].reset();
        $('#modalForm').modal('show');
    }

    function editData(id, kode, bahan_kajian) {
        $('#modalTitle').text('Edit Data');
        $('#formData').attr('action', '/bahan-kajian/' + id);
        $('#methodField').val('PUT');
        $('#kode').val(kode);
        $('#bahan_kajian').val(bahan_kajian);
        $('#modalForm').modal('show');
    }
</script>
@endsection
