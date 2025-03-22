<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $data = MataKuliah::all();
        return view('mata_kuliah.index', compact('data'));
    }

    public function store(Request $request)
    {
        MataKuliah::create($request->all());
        return redirect()->back()->with('success', 'Mata Kuliah berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $mk = MataKuliah::findOrFail($id);
        $mk->update($request->all());
        return redirect()->back()->with('success', 'Mata Kuliah berhasil diperbarui');
    }

    public function destroy($id)
    {
        MataKuliah::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Mata Kuliah berhasil dihapus');
    }
}
