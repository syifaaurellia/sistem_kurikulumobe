<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CPMK;

class CPMKController extends Controller
{
    public function index()
    {
        $cpmk = CPMK::all();
        return view('cpmk.index', compact('cpmk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_cpmk' => 'required|string|max:255|unique:cpmk,kode_cpmk',
            'deskripsi_cpmk' => 'required|string',
        ]);

        CPMK::create([
            'kode_cpmk' => $request->kode_cpmk,
            'deskripsi_cpmk' => $request->deskripsi_cpmk,
        ]);

        return redirect()->route('cpmk.index')->with('success', 'CPMK berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_cpmk' => 'required|string|max:255|unique:cpmk,kode_cpmk,'.$id,
            'deskripsi_cpmk' => 'required|string',
        ]);

        $cpmk = CPMK::findOrFail($id);
        $cpmk->update([
            'kode_cpmk' => $request->kode_cpmk,
            'deskripsi_cpmk' => $request->deskripsi_cpmk,
        ]);

        return redirect()->route('cpmk.index')->with('success', 'CPMK berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $cpmk = CPMK::findOrFail($id);
        $cpmk->delete();

        return redirect()->route('cpmk.index')->with('success', 'CPMK berhasil dihapus!');
    }
}
