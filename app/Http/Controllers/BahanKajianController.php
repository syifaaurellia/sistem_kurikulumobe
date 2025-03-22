<?php

namespace App\Http\Controllers;

use App\Models\BahanKajian;
use Illuminate\Http\Request;

class BahanKajianController extends Controller
{
    public function index()
    {
        $data = BahanKajian::all();
        return view('bahan-kajian.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'bahan_kajian' => 'required|string'
        ]);

        BahanKajian::create($request->all());
        return redirect()->route('bahan-kajian.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, BahanKajian $bahan_kajian)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'bahan_kajian' => 'required|string'
        ]);

        $bahan_kajian->update($request->all());
        return redirect()->route('bahan-kajian.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(BahanKajian $bahan_kajian)
    {
        $bahan_kajian->delete();
        return redirect()->route('bahan-kajian.index')->with('success', 'Data berhasil dihapus');
    }
}
