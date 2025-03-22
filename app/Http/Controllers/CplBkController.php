<?php

namespace App\Http\Controllers;

use App\Models\BahanKajian;
use App\Models\CplBk;
use App\Models\CplProdi;
use Illuminate\Http\Request;

class CplBkController extends Controller
{
    public function index()
    {
        $cplBk = CplBk::with(['cplProdi', 'bk'])->get();
        return view('cpl-bk.index', compact('cplBk'));
    }

    public function create()
    {
        $cpl = CplProdi::all();
        $bk = BahanKajian::all();
        return view('cpl-bk.create', compact('cpl', 'bk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_cpl' => 'required',
            'kode' => 'required',
        ]);

        CplBk::create($request->all());
        return redirect()->route('cpl-bk.index')->with('success', 'Relasi CPL-BK berhasil ditambahkan.');
    }

    public function edit($id)
{
    $cplBk = CplBk::findOrFail($id);
    $cplProdi = CplProdi::all();
    $bahanKajian = BahanKajian::all();

    return view('cpl-bk.edit', compact('cplBk', 'cplProdi', 'bahanKajian'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_cpl' => 'required',
            'kode' => 'required',
        ]);

        $cplBk = CplBk::findOrFail($id);
        $cplBk->update($request->all());

        return redirect()->route('cpl-bk.index')->with('success', 'Relasi CPL-BK berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $cplBk = CplBk::findOrFail($id);
        $cplBk->delete();

        return redirect()->route('cpl-bk.index')->with('success', 'Relasi CPL-BK berhasil dihapus.');
    }
}
