<?php

namespace App\Http\Controllers;

use App\Models\CplProdi;
use Illuminate\Http\Request;

class CplProdiController extends Controller
{
    public function index()
    {
        $data = CplProdi::all();
        return view('cpl_prodi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_cpl' => 'required|unique:cpl_prodi,kode_cpl',
            'deskripsi_cpl' => 'required',
        ]);

        CplProdi::create($request->all());
        return redirect()->route('cpl-prodi.index')->with('success', 'CPL Prodi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_cpl' => 'required|unique:cpl_prodi,kode_cpl,'.$id,
            'deskripsi_cpl' => 'required',
        ]);

        $cplProdi = CplProdi::findOrFail($id);
        $cplProdi->update($request->all());
        return redirect()->route('cpl-prodi.index')->with('success', 'CPL Prodi berhasil diupdate');
    }

    public function destroy($id)
    {
        $cplProdi = CplProdi::findOrFail($id);
        $cplProdi->delete();
        return redirect()->route('cpl-prodi.index')->with('success', 'CPL Prodi berhasil dihapus');
    }
}

