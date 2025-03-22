@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pemenuhan CPL</h2>
    <form action="{{ route('pemenuhan-cpl.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>CPL</label>
            <select name="cpl_id" class="form-control">
                @foreach($cplList as $cpl)
                    <option value="{{ $cpl->id }}">{{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}</option>
                @endforeach
            </select>
        </div>

        <div id="mata-kuliah-container">
            <div class="mb-3 mata-kuliah-group">
                <label>Mata Kuliah</label>
                <select name="mata_kuliah_id[]" class="form-control">
                    @foreach($mataKuliahList as $mk)
                        <option value="{{ $mk->id }}">{{ $mk->mata_kuliah }}</option>
                    @endforeach
                </select>
                
                <label>Semester</label>
                <select name="semester[]" class="form-control">
                    @for ($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                <button type="button" class="btn btn-danger remove-mata-kuliah">Hapus</button>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" id="add-mata-kuliah">Tambah Mata Kuliah</button>

        <br><br>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

<script>
    document.getElementById('add-mata-kuliah').addEventListener('click', function() {
        let container = document.getElementById('mata-kuliah-container');
        let newField = document.createElement('div');
        newField.classList.add('mb-3', 'mata-kuliah-group');
        newField.innerHTML = `
            <label>Mata Kuliah</label>
            <select name="mata_kuliah_id[]" class="form-control">
                @foreach($mataKuliahList as $mk)
                    <option value="{{ $mk->id }}">{{ $mk->mata_kuliah }}</option>
                @endforeach
            </select>

            <label>Semester</label>
            <select name="semester[]" class="form-control">
                @for ($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <button type="button" class="btn btn-danger remove-mata-kuliah">Hapus</button>
        `;
        container.appendChild(newField);
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-mata-kuliah')) {
            event.target.parentElement.remove();
        }
    });
</script>
@endsection
