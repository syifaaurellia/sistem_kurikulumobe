<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RangeNilai;

class RangeNilaiController extends Controller
{
    public function index() {
        $rangeNilai = RangeNilai::all();
        return view('range_nilai.index', compact('rangeNilai'));
    }

    public function store(Request $request) {
        $request->validate([
            'dari' => 'required|numeric',
            'hingga' => 'required|numeric',
            'hasil' => 'required'
        ]);

        RangeNilai::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'dari' => 'required|numeric',
            'hingga' => 'required|numeric',
            'hasil' => 'required'
        ]);

        $data = RangeNilai::findOrFail($id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id) {
        RangeNilai::destroy($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
