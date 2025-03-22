<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CplCpmkMk;
use App\Models\CplProdi;
use App\Models\Cpmk;
use App\Models\MataKuliah;

class CplCpmkMkController extends Controller
{
    public function index()
    {
        $relasi = CplCpmkMk::with(['cpl', 'cpmk', 'mataKuliah'])->get();
        return view('cpl_cpmk_mk.index', compact('relasi'));
    }

    public function create()
    {
        $cplList = CplProdi::all();
        $cpmkList = Cpmk::all();
        $mkList = MataKuliah::all();
        return view('cpl_cpmk_mk.create', compact('cplList', 'cpmkList', 'mkList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cpl_id' => 'required|exists:cpl_prodi,id',
            'cpmk_id' => 'required|exists:cpmk,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
        ]);

        CplCpmkMk::create($request->all());

        return redirect()->route('cpl_cpmk_mk.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = CplCpmkMk::findOrFail($id);
        $cplList = CplProdi::all();
        $cpmkList = Cpmk::all();
        $mkList = MataKuliah::all();
        return view('cpl_cpmk_mk.edit', compact('item', 'cplList', 'cpmkList', 'mkList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cpl_id' => 'required|exists:cpl_prodi,id',
            'cpmk_id' => 'required|exists:cpmk,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
        ]);

        $relasi = CplCpmkMk::findOrFail($id);
        $relasi->update($request->all());

        return redirect()->route('cpl_cpmk_mk.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        CplCpmkMk::findOrFail($id)->delete();
        return redirect()->route('cpl_cpmk_mk.index')->with('success', 'Data berhasil dihapus!');
    }
}
