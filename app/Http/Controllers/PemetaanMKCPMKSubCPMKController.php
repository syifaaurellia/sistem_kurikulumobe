<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemetaanMKCPMKSubCPMK;
use App\Models\MataKuliah;
use App\Models\CPMK;
use App\Models\SubCPMK;

class PemetaanMKCPMKSubCPMKController extends Controller
{
    public function index()
    {
        $pemetaan = PemetaanMKCPMKSubCPMK::with(['mataKuliah', 'cpmk', 'subCpmk'])->get();
        return view('pemetaansubcpmk.index', compact('pemetaan'));
    }

    public function create()
    {
        $mataKuliah = MataKuliah::all();
        $cpmk = CPMK::all();
        $subCpmk = SubCPMK::all();
        return view('pemetaansubcpmk.create', compact('mataKuliah', 'cpmk', 'subCpmk'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
        'cpmk' => 'required|array',
        'cpmk.*.id' => 'required|exists:cpmk,id',
        'cpmk.*.sub_cpmk' => 'required|array',
        'cpmk.*.sub_cpmk.*.id' => 'required|exists:sub_cpmk,id',
    ]);

    foreach ($request->cpmk as $cpmk) {
        foreach ($cpmk['sub_cpmk'] as $subCpmk) {
            PemetaanMKCPMKSubCPMK::create([
                'mata_kuliah_id' => $request->mata_kuliah_id,
                'cpmk_id' => $cpmk['id'],
                'sub_cpmk_id' => $subCpmk['id'],
            ]);
        }
    }

    return redirect()->route('pemetaansubcpmk.index')->with('success', 'Pemetaan berhasil ditambahkan');
}

public function edit($id)
{
    $pemetaan = PemetaanMKCPMKSubCPMK::find($id);

    if (!$pemetaan) {
        return redirect()->route('pemetaansubcpmk.index')->with('error', 'Data tidak ditemukan.');
    }

    $mataKuliah = MataKuliah::all();
    $cpmk = CPMK::all();
    $subCpmk = SubCPMK::all();

    return view('pemetaansubcpmk.edit', compact('pemetaan', 'mataKuliah', 'cpmk', 'subCpmk'));
}



    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'cpmk_id' => 'required|exists:cpmk,id',
            'sub_cpmk_id' => 'required|exists:sub_cpmk,id',
        ]);

        $pemetaan = PemetaanMKCPMKSubCPMK::findOrFail($id);
        $pemetaan->update($validatedData);

        return redirect()->route('pemetaansubcpmk.index')->with('success', 'Pemetaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pemetaan = PemetaanMKCPMKSubCPMK::findOrFail($id);
        $pemetaan->delete();

        return redirect()->route('pemetaansubcpmk.index')->with('success', 'Pemetaan berhasil dihapus');
    }
}
