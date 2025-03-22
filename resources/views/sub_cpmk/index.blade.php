@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sub CPMK</h2>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalSubCPMK" onclick="resetForm()">Tambah Sub CPMK</button>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Sub CPMK</th>
                <th>Uraian Sub CPMK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sub_cpmk as $item)
            <tr>
                <td>{{ $item->kode_sub_cpmk }}</td>
                <td>{{ $item->uraian_sub_cpmk }}</td>
                <td>
                    <button class="btn btn-warning btn-sm edit-btn"
                        data-id="{{ $item->id }}" 
                        data-kode="{{ $item->kode_sub_cpmk }}" 
                        data-uraian="{{ $item->uraian_sub_cpmk }}"
                        data-toggle="modal" data-target="#modalSubCPMK">
                        Edit
                    </button>

                    <form action="{{ route('sub_cpmk.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Sub CPMK ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalSubCPMK" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Sub CPMK</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formSubCPMK" method="POST">
                    @csrf
                    <input type="hidden" id="sub_cpmk_id" name="sub_cpmk_id">
                    <div id="methodField"></div>

                    <div class="form-group">
                        <label>Kode Sub CPMK</label>
                        <input type="text" id="kode_sub_cpmk" name="kode_sub_cpmk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Uraian Sub CPMK</label>
                        <textarea id="uraian_sub_cpmk" name="uraian_sub_cpmk" class="form-control" required></textarea>
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
            document.getElementById('formSubCPMK').action = `/sub_cpmk/${id}`;
            document.getElementById('modalTitle').innerText = "Edit Sub CPMK";
            document.getElementById('sub_cpmk_id').value = id;
            document.getElementById('kode_sub_cpmk').value = this.dataset.kode;
            document.getElementById('uraian_sub_cpmk').value = this.dataset.uraian;

            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        });
    });
});

function resetForm() {
    document.getElementById('formSubCPMK').action = "{{ route('sub_cpmk.store') }}";
    document.getElementById('modalTitle').innerText = "Tambah Sub CPMK";
    document.getElementById('sub_cpmk_id').value = "";
    document.getElementById('kode_sub_cpmk').value = "";
    document.getElementById('uraian_sub_cpmk').value = "";
    document.getElementById('methodField').innerHTML = "";
}
</script>
@endsection
