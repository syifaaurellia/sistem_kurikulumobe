<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\CPLProdi;
use App\Models\MataKuliah;
use App\Models\CPMK;

class PenilaianController extends Controller
{
    public function index()
{
    $penilaian = Penilaian::with(['cpl', 'mataKuliah', 'cpmk'])->get();
    return view('penilaian.index', compact('penilaian'));
}


    public function create()
    {
        $cpl = CPLProdi::all();
        $mataKuliah = MataKuliah::all();
        $cpmk = CPMK::all();
        return view('penilaian.create', compact('cpl', 'mataKuliah', 'cpmk'));
    }

    public function store(Request $request)
{
    $request->validate([
        'cpl_id' => 'required',
        'mk' => 'required|array', // Validasi array mk
        'mk.*.id' => 'required|exists:mata_kuliah,id', // Pastikan MK ada di database
        'mk.*.cpmk_id' => 'required|exists:cpmk,id', // Pastikan CPMK ada di database
    ]);

    foreach ($request->mk as $data) {
        Penilaian::create([
            'cpl_id' => $request->cpl_id,
            'mk_id' => $data['id'],
            'cpmk_id' => $data['cpmk_id'],
            'quiz_tugas' => in_array('quiz_tugas', $data['metode_penilaian'] ?? []) ? 1 : 0,
            'observasi_praktek' => in_array('observasi_praktek', $data['metode_penilaian'] ?? []) ? 1 : 0,
            'unjuk_kerja' => in_array('unjuk_kerja', $data['metode_penilaian'] ?? []) ? 1 : 0,
            'uts' => in_array('uts', $data['metode_penilaian'] ?? []) ? 1 : 0,
            'uas' => in_array('uas', $data['metode_penilaian'] ?? []) ? 1 : 0,
            'tugas_kelompok' => in_array('tugas_kelompok', $data['metode_penilaian'] ?? []) ? 1 : 0,
        ]);
    }

    return redirect()->route('penilaian.index')->with('success', 'Data Metode Penilaian Berhasil Ditambahkan');
}


    public function edit($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $cpl = CPLProdi::all();
        $mataKuliah = MataKuliah::all();
        $cpmk = CPMK::all();
        return view('penilaian.edit', compact('penilaian', 'cpl', 'mataKuliah', 'cpmk'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'cpl_id' => 'required',
        'mk' => 'required|array',
        'mk.*.id' => 'required|exists:mata_kuliah,id',
        'mk.*.cpmk_id' => 'required|exists:cpmk,id',
    ]);

    $penilaian = Penilaian::findOrFail($id);

    foreach ($request->mk as $data) {
        $penilaian->update([
            'cpl_id' => $request->cpl_id,
            'mk_id' => $data['id'],
            'cpmk_id' => $data['cpmk_id'],
            'quiz_tugas' => in_array('quiz_tugas', $data['metode_penilaian'] ?? []) ? 1 : 0,
            'observasi_praktek' => in_array('observasi_praktek', $data['metode_penilaian'] ?? []) ? 1 : 0,
            'unjuk_kerja' => in_array('unjuk_kerja', $data['metode_penilaian'] ?? []) ? 1 : 0,
            'uts' => in_array('uts', $data['metode_penilaian'] ?? []) ? 1 : 0,
            'uas' => in_array('uas', $data['metode_penilaian'] ?? []) ? 1 : 0,
            'tugas_kelompok' => in_array('tugas_kelompok', $data['metode_penilaian'] ?? []) ? 1 : 0,
        ]);
    }

    return redirect()->route('penilaian.index')->with('success', 'Data Metode Penilaian Berhasil Diperbarui');
}

    public function destroy($id)
    {
        Penilaian::destroy($id);
        return redirect()->route('penilaian.index')->with('success', 'Data Metode Penilaian Berhasil Dihapus');
    }

}
