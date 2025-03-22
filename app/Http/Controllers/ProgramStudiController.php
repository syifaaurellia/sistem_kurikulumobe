<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramStudi;

class ProgramStudiController extends Controller
{
    public function index() {
        $programStudi = ProgramStudi::all();
        return view('program_studi.index', compact('programStudi'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_prodi' => 'required',
            'kode_prodi' => 'required|unique:program_studis,kode_prodi',
            'nama_kaprodi' => 'required'
        ]);

        ProgramStudi::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_prodi' => 'required',
            'kode_prodi' => 'required|unique:program_studis,kode_prodi,'.$id,
            'nama_kaprodi' => 'required'
        ]);

        $data = ProgramStudi::findOrFail($id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id) {
        ProgramStudi::destroy($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
