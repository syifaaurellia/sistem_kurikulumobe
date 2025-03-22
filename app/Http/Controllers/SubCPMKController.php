<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCPMK;

class SubCPMKController extends Controller
{
    public function index()
    {
        $sub_cpmk = SubCPMK::all();
        return view('sub_cpmk.index', compact('sub_cpmk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_sub_cpmk' => 'required|string|max:255|unique:sub_cpmk,kode_sub_cpmk',
            'uraian_sub_cpmk' => 'required|string',
        ]);

        SubCPMK::create([
            'kode_sub_cpmk' => $request->kode_sub_cpmk,
            'uraian_sub_cpmk' => $request->uraian_sub_cpmk,
        ]);

        return redirect()->route('sub_cpmk.index')->with('success', 'Sub CPMK berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_sub_cpmk' => 'required|string|max:255|unique:sub_cpmk,kode_sub_cpmk,'.$id,
            'uraian_sub_cpmk' => 'required|string',
        ]);

        $sub_cpmk = SubCPMK::findOrFail($id);
        $sub_cpmk->update([
            'kode_sub_cpmk' => $request->kode_sub_cpmk,
            'uraian_sub_cpmk' => $request->uraian_sub_cpmk,
        ]);

        return redirect()->route('sub_cpmk.index')->with('success', 'Sub CPMK berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $sub_cpmk = SubCPMK::findOrFail($id);
        $sub_cpmk->delete();

        return redirect()->route('sub_cpmk.index')->with('success', 'Sub CPMK berhasil dihapus!');
    }
}
