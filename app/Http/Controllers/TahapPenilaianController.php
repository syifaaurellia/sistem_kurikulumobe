<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahapPenilaian;
use App\Models\Penilaian;

class TahapPenilaianController extends Controller
{
    public function index()
{
    // Ambil data tahap penilaian beserta data CPL, MK, dan CPMK dari relasi Penilaian
    $tahapPenilaian = TahapPenilaian::with(['penilaian', 'cpl', 'mataKuliah', 'cpmk'])->get();

    return view('tahap_penilaian.index', compact('tahapPenilaian'));
}

public function create()
{
    // Ambil daftar penilaian yang sudah memiliki relasi CPL, MK, dan CPMK
    $penilaian = Penilaian::with(['cpl', 'mataKuliah', 'cpmk'])->get();
    
    return view('tahap_penilaian.create', compact('penilaian'));
}


public function store(Request $request)
{
    $validatedData = $request->validate([
        'penilaian_id' => 'required',
        'tahap_penilaian' => 'required',
        'teknik_penilaian' => 'nullable|string',
        'instrumen' => 'nullable|string',
        'kriteria' => 'nullable|string',
        'bobot' => 'nullable|integer|min:0|max:100',
    ]);

    // Jika ada kolom yang kosong, isi dengan '0'
    $validatedData = array_map(fn($value) => $value ?? '0', $validatedData);

    TahapPenilaian::create($validatedData);

    return redirect()->route('tahap_penilaian.index')->with('success', 'Data berhasil ditambahkan');
}

    public function edit($id)
{
    $tahap_penilaian = TahapPenilaian::findOrFail($id);
    
    // Ambil data Penilaian yang lengkap dengan relasinya
    $penilaian = Penilaian::with(['cpl', 'mataKuliah', 'cpmk'])->get();

    return view('tahap_penilaian.edit', compact('tahap_penilaian', 'penilaian'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'penilaian_id' => 'required',
        'tahap_penilaian' => 'required',
        'teknik_penilaian' => 'nullable|string',
        'instrumen' => 'nullable|string',
        'kriteria' => 'nullable|string',
        'bobot' => 'nullable|integer|min:0|max:100',
    ]);

    // Jika ada kolom yang kosong, isi dengan '0'
    $validatedData = array_map(fn($value) => $value ?? '0', $validatedData);

    $tahap_penilaian = TahapPenilaian::findOrFail($id);
    $tahap_penilaian->update($validatedData);

    return redirect()->route('tahap_penilaian.index')->with('success', 'Data berhasil diperbarui');
}

    public function destroy($id)
    {
        $tahap_penilaian = TahapPenilaian::findOrFail($id);
        $tahap_penilaian->delete();

        return redirect()->route('tahap_penilaian.index')->with('success', 'Data berhasil dihapus');
    }
}
