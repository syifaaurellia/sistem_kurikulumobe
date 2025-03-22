<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BobotPenilaian;
use App\Models\PemetaanCplMkCpmk;

class BobotPenilaianController extends Controller
{
    // Menampilkan daftar Bobot Penilaian
    public function index()
    {
        $bobotPenilaian = BobotPenilaian::with('pemetaan')->get();
        return view('bobot-penilaian.index', compact('bobotPenilaian'));
    }

    // Menampilkan form tambah Bobot Penilaian
    public function create()
    {
        $pemetaan = PemetaanCplMkCpmk::with(['cpl', 'mataKuliah', 'cpmk'])->get();
        return view('bobot-penilaian.create', compact('pemetaan'));
    }

    // Menyimpan data Bobot Penilaian
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'id_pemetaan_cpl_mk_cpmk' => 'required|exists:pemetaan_cpl_mk_cpmk,id',
        'quiz_tugas' => 'nullable|numeric',
        'observasi_praktek' => 'nullable|numeric',
        'unjuk_kerja' => 'nullable|numeric',
        'uts' => 'nullable|numeric',
        'uas' => 'nullable|numeric',
        'tugas_kelompok' => 'nullable|numeric'
    ]);

    // Ubah nilai kosong (null) menjadi 0
    $validatedData = array_map(fn($value) => $value ?? 0, $validatedData);

    BobotPenilaian::create($validatedData);

    return redirect()->route('bobot-penilaian.index')->with('success', 'Bobot Penilaian berhasil ditambahkan');
}

    // Menampilkan form edit Bobot Penilaian
    public function edit($id)
    {
        $bobotPenilaian = BobotPenilaian::findOrFail($id);
        $pemetaan = PemetaanCplMkCpmk::with(['cpl', 'mataKuliah', 'cpmk'])->get();
        return view('bobot-penilaian.edit', compact('bobotPenilaian', 'pemetaan'));
    }

    // Update data Bobot Penilaian
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'id_pemetaan_cpl_mk_cpmk' => 'required|exists:pemetaan_cpl_mk_cpmk,id',
        'quiz_tugas' => 'nullable|numeric',
        'observasi_praktek' => 'nullable|numeric',
        'unjuk_kerja' => 'nullable|numeric',
        'uts' => 'nullable|numeric',
        'uas' => 'nullable|numeric',
        'tugas_kelompok' => 'nullable|numeric'
    ]);

    // Ubah nilai kosong (null) menjadi 0
    $validatedData = array_map(fn($value) => $value ?? 0, $validatedData);

    $bobotPenilaian = BobotPenilaian::findOrFail($id);
    $bobotPenilaian->update($validatedData);

    return redirect()->route('bobot-penilaian.index')->with('success', 'Bobot Penilaian berhasil diperbarui');
}

    // Hapus Bobot Penilaian
    public function destroy($id)
    {
        $bobotPenilaian = BobotPenilaian::findOrFail($id);
        $bobotPenilaian->delete();
        return redirect()->route('bobot-penilaian.index')->with('success', 'Bobot Penilaian berhasil dihapus');
    }
}
