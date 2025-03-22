@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pemenuhan CPL</h2>
    <form action="{{ route('pemenuhan-cpl.update', $pemenuhanCPL->first()->cpl_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>CPL</label>
            <select name="cpl_id" class="form-control">
                @foreach($cplList as $cpl)
                    <option value="{{ $cpl->id }}" {{ $cpl->id == $pemenuhanCPL->first()->cpl_id ? 'selected' : '' }}>
                        {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="mata-kuliah-container">
            @foreach ($pemenuhanCPL as $item)
                <div class="mb-3 mata-kuliah-row">
                    <label>Mata Kuliah</label>
                    <select name="mata_kuliah_id[]" class="form-control">
                        @foreach($mataKuliahList as $mk)
                            <option value="{{ $mk->id }}" {{ $mk->id == $item->mata_kuliah_id ? 'selected' : '' }}>
                                {{ $mk->mata_kuliah }}
                            </option>
                        @endforeach
                    </select>

                    <label>Semester</label>
                    <select name="semester[]" class="form-control">
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ $i == $item->semester ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>

                    <button type="button" class="btn btn-danger remove-mata-kuliah">Hapus</button>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-success" id="add-mata-kuliah">Tambah Mata Kuliah</button>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    document.getElementById('add-mata-kuliah').addEventListener('click', function() {
        let container = document.getElementById('mata-kuliah-container');
        let newRow = container.querySelector('.mata-kuliah-row').cloneNode(true);
        newRow.querySelector('select[name="mata_kuliah_id[]"]').value = "";
        newRow.querySelector('select[name="semester[]"]').value = "";
        container.appendChild(newRow);

        newRow.querySelector('.remove-mata-kuliah').addEventListener('click', function() {
            newRow.remove();
        });
    });

    document.querySelectorAll('.remove-mata-kuliah').forEach(button => {
        button.addEventListener('click', function() {
            button.parentElement.remove();
        });
    });
</script>

@endsection
