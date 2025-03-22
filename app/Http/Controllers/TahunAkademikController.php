<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;

class TahunAkademikController extends Controller
{
    public function index() {
        $tahunAkademik = TahunAkademik::all();
        return view('tahun_akademik.index', compact('tahunAkademik'));
    }

    public function store(Request $request) {
        $request->validate([
            'tahun' => 'required',
            'semester' => 'required',
            'kurikulum' => 'required'
        ]);

        TahunAkademik::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'tahun' => 'required',
            'semester' => 'required',
            'kurikulum' => 'required'
        ]);

        $data = TahunAkademik::findOrFail($id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id) {
        TahunAkademik::destroy($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
