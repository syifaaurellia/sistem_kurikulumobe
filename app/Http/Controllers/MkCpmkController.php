<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MkCpmk;
use App\Models\MataKuliah;
use App\Models\Cpmk;

class MkCpmkController extends Controller
{
    public function index()
    {
        $mkCpmks = MkCpmk::join('mata_kuliah', 'mk_cpmks.kode_mk', '=', 'mata_kuliah.kode_mk')
            ->join('cpmk', 'mk_cpmks.kode_cpmk', '=', 'cpmk.kode_cpmk')
            ->select('mk_cpmks.*', 'mata_kuliah.mata_kuliah', 'cpmk.deskripsi_cpmk')
            ->get();

        return view('mk-cpmk.index', compact('mkCpmks'));
    }

    public function create()
    {
        $mataKuliahs = MataKuliah::all();
        $cpmks = Cpmk::all();
        return view('mk-cpmk.create', compact('mataKuliahs', 'cpmks'));
    }

    public function store(Request $request)
    {
        MkCpmk::create($request->all());
        return redirect()->route('mk-cpmk.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mkCpmk = MkCpmk::findOrFail($id);
        $mataKuliahs = MataKuliah::all();
        $cpmks = Cpmk::all();
        return view('mk-cpmk.edit', compact('mkCpmk', 'mataKuliahs', 'cpmks'));
    }

    public function update(Request $request, $id)
    {
        $mkCpmk = MkCpmk::findOrFail($id);
        $mkCpmk->update($request->all());
        return redirect()->route('mk-cpmk.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        MkCpmk::destroy($id);
        return redirect()->route('mk-cpmk.index')->with('success', 'Data berhasil dihapus');
    }
}

