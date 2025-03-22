<?php

namespace App\Http\Controllers;

use App\Models\BahanKajian;
use App\Models\BkMk;
use App\Models\Bk;
use App\Models\MataKuliah;
use App\Models\Mk;
use Illuminate\Http\Request;

class BkMkController extends Controller
{
    public function index()
    {
        $bkMk = BkMk::with(['bk', 'mk'])->get();
        return view('bk-mk.index', compact('bkMk'));
    }

    public function create()
    {
        $bk = BahanKajian::all();
        $mk = MataKuliah::all();
        return view('bk-mk.create', compact('bk', 'mk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'kode_mk' => 'required',
        ]);

        BkMk::create($request->all());
        return redirect()->route('bk-mk.index')->with('success', 'Pemetaan BK-MK berhasil ditambah.');
    }

    public function edit($id)
    {
        $bkMk = BkMk::findOrFail($id);
        $bk = BahanKajian::all();
        $mk = MataKuliah::all();
        return view('bk-mk.edit', compact('bkMk', 'bk', 'mk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'kode_mk' => 'required',
        ]);

        $bkMk = BkMk::findOrFail($id);
        $bkMk->update($request->all());
        return redirect()->route('bk-mk.index')->with('success', 'Pemetaan BK-MK berhasil diupdate.');
    }

    public function destroy($id)
    {
        $bkMk = BkMk::findOrFail($id);
        $bkMk->delete();
        return redirect()->route('bk-mk.index')->with('success', 'Pemetaan BK-MK berhasil dihapus.');
    }
}
