<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemenuhanCPLCPMKMK;
use App\Models\CPLProdi;
use App\Models\CPMK;
use App\Models\MataKuliah;

class PemenuhanCPLCPMKMKController extends Controller
{
    public function index()
    {
        $data = PemenuhanCPLCPMKMK::with(['cpl', 'cpmk', 'mataKuliah'])->get();
        return view('pemenuhan.index', compact('data'));
    }

    public function create()
    {
        $cplList = CPLProdi::all();
        $cpmkList = CPMK::all();
        $mataKuliahList = MataKuliah::all();
        return view('pemenuhan.create', compact('cplList', 'cpmkList', 'mataKuliahList'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'cpl_id' => 'required|exists:cpl_prodi,id',
        'cpmk' => 'required|array',
        'cpmk.*.id' => 'required|exists:cpmk,id',
        'cpmk.*.mata_kuliah' => 'required|array',
        'cpmk.*.mata_kuliah.*.id' => 'required|exists:mata_kuliah,id',
        'cpmk.*.mata_kuliah.*.semester' => 'required|integer|min:1|max:8'
    ]);

    foreach ($validatedData['cpmk'] as $cpmk) {
        foreach ($cpmk['mata_kuliah'] as $mk) {
            PemenuhanCPLCPMKMK::create([
                'cpl_id' => $validatedData['cpl_id'],
                'cpmk_id' => $cpmk['id'],
                'mata_kuliah_id' => $mk['id'],
                'semester' => $mk['semester']
            ]);
        }
    }

    return redirect()->route('pemenuhan.index')->with('success', 'Data berhasil ditambahkan');
}

public function edit($id)
{
    $item = PemenuhanCPLCPMKMK::findOrFail($id);
    $cplList = CPLProdi::all();
    $cpmkList = CPMK::all();
    $mataKuliahList = MataKuliah::all();

    return view('pemenuhan.edit', compact('item', 'cplList', 'cpmkList', 'mataKuliahList'));
}

    public function update(Request $request, $id)
    {
        // Validasi lebih ketat
        $validatedData = $request->validate([
            'cpl_id' => 'required|exists:cpl_prodi,id',
            'cpmk_id' => 'required|exists:cpmk,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'semester' => 'required|integer|min:1|max:8'
        ]);

        $item = PemenuhanCPLCPMKMK::findOrFail($id);
        $item->update($validatedData);

        return redirect()->route('pemenuhan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $item = PemenuhanCPLCPMKMK::findOrFail($id);
        $item->delete();

        return redirect()->route('pemenuhan.index')->with('success', 'Data berhasil dihapus');
    }
}
