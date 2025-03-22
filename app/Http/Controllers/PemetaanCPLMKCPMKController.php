<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemetaanCPLMKCPMK;
use App\Models\MataKuliah;
use App\Models\CPLProdi;
use App\Models\CPMK;
use Illuminate\Support\Facades\DB;

class PemetaanCPLMKCPMKController extends Controller
{
    public function index()
    {
        $pemetaan = PemetaanCPLMKCPMK::with(['mataKuliah', 'cpl', 'cpmk'])
                    ->orderBy('id', 'asc') // atau orderBy('mata_kuliah_id', 'asc')
                    ->get();

        return view('pemetaan.index', compact('pemetaan'));
    }


    public function create()
    {
        $mataKuliah = MataKuliah::all();
        $cpl = CPLProdi::all();
        $cpmk = CPMK::all();
        return view('pemetaan.create', compact('mataKuliah', 'cpl', 'cpmk'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mata_kuliah_id' => 'required|integer|exists:mata_kuliah,id',
            'cpl' => 'required|array',
            'cpl.*.id' => 'required|integer|exists:cpl_prodi,id',
            'cpl.*.cpmk' => 'required|array',
            'cpl.*.cpmk.*.id' => 'required|integer|exists:cpmk,id',
        ]);

        foreach ($validatedData['cpl'] as $cpl) {
            foreach ($cpl['cpmk'] as $cpmk) {
                PemetaanCPLMKCPMK::create([
                    'mata_kuliah_id' => $validatedData['mata_kuliah_id'],
                    'cpl_id' => $cpl['id'],
                    'cpmk_id' => $cpmk['id'],
                ]);
            }
        }

        return redirect()->route('pemetaan.index')->with('success', 'Pemetaan berhasil ditambahkan');
    }

    public function edit($id)
{
    $pemetaanData = PemetaanCPLMKCPMK::where('mata_kuliah_id', $id)->get();

    if ($pemetaanData->isEmpty()) {
        return redirect()->route('pemetaan.index')->with('error', 'Data tidak ditemukan.');
    }

    $mataKuliah = MataKuliah::all();
    $cpl = CPLProdi::all();
    $cpmk = CPMK::all();

    return view('pemetaan.edit', compact('pemetaanData', 'mataKuliah', 'cpl', 'cpmk'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'mata_kuliah_id' => 'required|integer|exists:mata_kuliah,id',
        'cpl' => 'required|array',
        'cpl.*.id' => 'required|integer|exists:cpl_prodi,id',
        'cpl.*.cpmk' => 'required|array',
        'cpl.*.cpmk.*.id' => 'required|integer|exists:cpmk,id',
    ]);

    DB::transaction(function () use ($id, $validatedData) {
        // Hapus semua pemetaan terkait mata kuliah
        PemetaanCPLMKCPMK::where('mata_kuliah_id', $id)->delete();

        // Simpan data baru
        foreach ($validatedData['cpl'] as $cpl) {
            foreach ($cpl['cpmk'] as $cpmk) {
                PemetaanCPLMKCPMK::create([
                    'mata_kuliah_id' => $validatedData['mata_kuliah_id'],
                    'cpl_id' => $cpl['id'],
                    'cpmk_id' => $cpmk['id'],
                ]);
            }
        }
    });

    return redirect()->route('pemetaan.index')->with('success', 'Data berhasil diperbarui');
}

    public function destroy($id)
    {
        $pemetaan = PemetaanCPLMKCPMK::where('id', $id)->first();
        if (!$pemetaan) {
            return redirect()->route('pemetaan.index')->with('error', 'Data tidak ditemukan.');
        }

        PemetaanCPLMKCPMK::where('mata_kuliah_id', $pemetaan->mata_kuliah_id)->delete();
        return redirect()->route('pemetaan.index')->with('success', 'Data berhasil dihapus');
    }
}
