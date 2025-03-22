@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="row">
        <!-- Tabel Tahun Akademik -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tahun Akademik</h6>
                    <button class="btn btn-primary btn-sm float-right" onclick="openCreate('tahunAkademik')">Tambah</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Kurikulum</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tahunAkademik as $ta)
                            <tr id="row_tahunAkademik_{{ $ta->id }}">
                                <td>{{ $ta->tahun }}</td>
                                <td>{{ $ta->semester }}</td>
                                <td>{{ $ta->kurikulum }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" 
                                            onclick="openEdit('tahunAkademik', '{{ $ta->id }}', '{{ $ta->tahun }}', '{{ $ta->semester }}', '{{ $ta->kurikulum }}')">Edit</button>
                                            <form action="{{ route('tahunAkademik.destroy', $ta->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Program Studi -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Program Studi</h6>
                    <button class="btn btn-primary btn-sm float-right" onclick="openCreate('programStudi')">Tambah</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode Prodi</th>
                                <th>Nama Prodi</th>
                                <th>Kaprodi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($programStudi as $ps)
                            <tr id="row_programStudi_{{ $ps->id }}">
                                <td>{{ $ps->kode_prodi }}</td>
                                <td>{{ $ps->nama_prodi }}</td>
                                <td>{{ $ps->nama_kaprodi }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" 
                                            onclick="openEdit('programStudi', '{{ $ps->id }}', '{{ $ps->kode_prodi }}', '{{ $ps->nama_prodi }}', '{{ $ps->nama_kaprodi }}')">Edit</button>
                                            <form action="{{ route('programStudi.destroy', $ps->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Range Nilai -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Range Nilai</h6>
                    <button class="btn btn-primary btn-sm float-right" onclick="openCreate('rangeNilai')">Tambah</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Dari</th>
                                <th>Hingga</th>
                                <th>Hasil</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rangeNilai as $rn)
                            <tr id="row_rangeNilai_{{ $rn->id }}">
                                <td>{{ $rn->dari }}</td>
                                <td>{{ $rn->hingga }}</td>
                                <td>{{ $rn->hasil }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" 
                                            onclick="openEdit('rangeNilai', '{{ $rn->id }}', '{{ $rn->dari }}', '{{ $rn->hingga }}', '{{ $rn->hasil }}')">Edit</button>
                                            <form action="{{ route('rangeNilai.destroy', $rn->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Data</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="editMethod" value="POST">
                    <input type="hidden" name="id" id="editId">
                    <div id="editFields"></div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openCreate(type) {
    $('#editForm').attr('action', '/' + type);
    $('#editMethod').val('POST');
    $('#editFields').html(getFormFields(type, '', '', ''));
    $('#editModal').modal('show');
}

function openEdit(type, id, val1, val2, val3) {
    $('#editId').val(id);
    $('#editMethod').val('PUT');
    $('#editForm').attr('action', '/' + type + '/' + id);
    $('#editFields').html(getFormFields(type, val1, val2, val3));
    $('#editModal').modal('show');
}

function getFormFields(type, val1, val2, val3) {
    let fields = '';

    if (type === 'tahunAkademik') {
        fields = `
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="text" class="form-control" name="tahun" value="${val1}" required>
            </div>
            <div class="form-group">
                <label for="semester">Semester</label>
                <input type="text" class="form-control" name="semester" value="${val2}" required>
            </div>
            <div class="form-group">
                <label for="kurikulum">Kurikulum</label>
                <input type="text" class="form-control" name="kurikulum" value="${val3}" required>
            </div>
        `;
    } else if (type === 'programStudi') {
        fields = `
            <div class="form-group">
                <label for="kode_prodi">Kode Prodi</label>
                <input type="text" class="form-control" name="kode_prodi" value="${val1}" required>
            </div>
            <div class="form-group">
                <label for="nama_prodi">Nama Prodi</label>
                <input type="text" class="form-control" name="nama_prodi" value="${val2}" required>
            </div>
            <div class="form-group">
                <label for="nama_kaprodi">Kaprodi</label>
                <input type="text" class="form-control" name="nama_kaprodi" value="${val3}" required>
            </div>
        `;
    } else if (type === 'rangeNilai') {
        fields = `
            <div class="form-group">
                <label for="dari">Dari</label>
                <input type="number" class="form-control" name="dari" value="${val1}" required>
            </div>
            <div class="form-group">
                <label for="hingga">Hingga</label>
                <input type="number" class="form-control" name="hingga" value="${val2}" required>
            </div>
            <div class="form-group">
                <label for="hasil">Hasil</label>
                <input type="text" class="form-control" name="hasil" value="${val3}" required>
            </div>
        `;
    }

    return fields;
}

</script>

@endsection
