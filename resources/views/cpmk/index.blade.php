@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Rumusan CPMK</h2>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalCPMK" onclick="resetForm()">Tambah CPMK</button>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode CPMK</th>
                <th>Deskripsi CPMK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cpmk as $item)
            <tr>
                <td>{{ $item->kode_cpmk }}</td>
                <td>{{ $item->deskripsi_cpmk }}</td>
                <td>
                    <button class="btn btn-warning btn-sm edit-btn"
                        data-id="{{ $item->id }}" 
                        data-kode="{{ $item->kode_cpmk }}" 
                        data-deskripsi="{{ $item->deskripsi_cpmk }}"
                        data-toggle="modal" data-target="#modalCPMK">
                        Edit
                    </button>

                    <form action="{{ route('cpmk.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus CPMK ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalCPMK" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah CPMK</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form id="formCPMK" method="POST">
                    @csrf
                    <input type="hidden" id="cpmk_id" name="cpmk_id">
                    <div id="methodField"></div> <!-- Untuk method PUT saat edit -->

                    <div class="form-group">
                        <label>Kode CPMK</label>
                        <input type="text" id="kode_cpmk" name="kode_cpmk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi CPMK</label>
                        <textarea id="deskripsi_cpmk" name="deskripsi_cpmk" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            let id = this.dataset.id;
            document.getElementById('formCPMK').action = `/cpmk/${id}`;
            document.getElementById('modalTitle').innerText = "Edit CPMK";
            document.getElementById('cpmk_id').value = id;
            document.getElementById('kode_cpmk').value = this.dataset.kode;
            document.getElementById('deskripsi_cpmk').value = this.dataset.deskripsi;

            // Tambahkan @method('PUT') untuk edit
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        });
    });
});

function resetForm() {
    document.getElementById('formCPMK').action = "{{ route('cpmk.store') }}";
    document.getElementById('modalTitle').innerText = "Tambah CPMK";
    document.getElementById('cpmk_id').value = "";
    document.getElementById('kode_cpmk').value = "";
    document.getElementById('deskripsi_cpmk').value = "";

    // Hapus method PUT saat tambah data
    document.getElementById('methodField').innerHTML = "";
}
</script>
@endsection
