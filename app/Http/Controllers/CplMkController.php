<?php

namespace App\Http\Controllers;

use App\Models\CplMk;
use App\Models\CplProdi;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class CplMkController extends Controller
{
    public function index()
{
    $cplMk = CplMk::with(['cplProdi', 'mataKuliah'])->get(); // Ambil data dengan relasi

    return view('cpl-mk.index', compact('cplMk')); // Kirim data ke view
}

    public function create()
{
    $cpl = CplProdi::all(); // Ambil semua data CPL
    $mk = MataKuliah::all(); // Ambil semua data Mata Kuliah

    return view('cpl-mk.create', compact('cpl', 'mk'));
}

    public function store(Request $request)
    {
        CplMk::create($request->all());
        return redirect()->route('cpl-mk.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
{
    $cplMk = CplMk::findOrFail($id);
    $cplProdi = CplProdi::all(); // Ambil daftar CPL
    $mataKuliah = MataKuliah::all(); // Ambil daftar MK

    return view('cpl-mk.edit', compact('cplMk', 'cplProdi', 'mataKuliah'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'kode_cpl' => 'required',
        'kode_mk' => 'required',
    ]);

    $cplMk = CplMk::findOrFail($id);
    $cplMk->update([
        'kode_cpl' => $request->kode_cpl,
        'kode_mk' => $request->kode_mk,
    ]);

    return redirect()->route('cpl-mk.index')->with('success', 'CPL-MK berhasil diperbarui.');
}


    public function destroy($id)
    {
        CplMk::destroy($id);
        return redirect()->route('cpl-mk.index')->with('success', 'Data berhasil dihapus');
    }
}
