<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BobotPenilaianCpl;
use App\Models\Penilaian;

class BobotPenilaianCplController extends Controller
{
    // Menampilkan daftar Bobot Penilaian CPL
    public function index()
    {
        $bobotPenilaian = BobotPenilaianCpl::with('penilaian')->get();
        return view('bobot-penilaian-cpl.index', compact('bobotPenilaian'));
    }

    // Menampilkan form tambah Bobot Penilaian CPL
    public function create()
    {
        $penilaian = Penilaian::all();
        return view('bobot-penilaian-cpl.create', compact('penilaian'));
    }

    // Menyimpan data Bobot Penilaian CPL
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'penilaian_id' => 'required|exists:penilaian,id',
            'quiz_tugas' => 'nullable|numeric',
            'observasi_praktek' => 'nullable|numeric',
            'unjuk_kerja' => 'nullable|numeric',
            'uts' => 'nullable|numeric',
            'uas' => 'nullable|numeric',
            'tugas_kelompok' => 'nullable|numeric'
        ]);

        // Set nilai null menjadi 0
        $validatedData = array_map(fn($value) => $value ?? 0, $validatedData);

        BobotPenilaianCpl::create($validatedData);

        return redirect()->route('bobot-penilaian-cpl.index')->with('success', 'Bobot Penilaian CPL berhasil ditambahkan');
    }

    // Menampilkan form edit Bobot Penilaian CPL
    public function edit($id)
    {
        $bobotPenilaian = BobotPenilaianCpl::findOrFail($id);
        $penilaian = Penilaian::all();
        return view('bobot-penilaian-cpl.edit', compact('bobotPenilaian', 'penilaian'));
    }

    // Update data Bobot Penilaian CPL
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'penilaian_id' => 'required|exists:penilaian,id',
            'quiz_tugas' => 'nullable|numeric',
            'observasi_praktek' => 'nullable|numeric',
            'unjuk_kerja' => 'nullable|numeric',
            'uts' => 'nullable|numeric',
            'uas' => 'nullable|numeric',
            'tugas_kelompok' => 'nullable|numeric'
        ]);

        // Set nilai null menjadi 0
        $validatedData = array_map(fn($value) => $value ?? 0, $validatedData);

        $bobotPenilaian = BobotPenilaianCpl::findOrFail($id);
        $bobotPenilaian->update($validatedData);

        return redirect()->route('bobot-penilaian-cpl.index')->with('success', 'Bobot Penilaian CPL berhasil diperbarui');
    }

    // Hapus Bobot Penilaian CPL
    public function destroy($id)
    {
        $bobotPenilaian = BobotPenilaianCpl::findOrFail($id);
        $bobotPenilaian->delete();
        return redirect()->route('bobot-penilaian-cpl.index')->with('success', 'Bobot Penilaian CPL berhasil dihapus');
    }
}
