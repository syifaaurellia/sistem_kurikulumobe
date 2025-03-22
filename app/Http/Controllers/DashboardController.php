<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\ProgramStudi;
use App\Models\RangeNilai;

class DashboardController extends Controller
{
    // Menampilkan halaman dashboard dengan data dari database
    public function index()
    {
        $tahunAkademik = TahunAkademik::all();
        $programStudi = ProgramStudi::all();
        $rangeNilai = RangeNilai::all();
        
        return view('dashboard', compact('tahunAkademik', 'programStudi', 'rangeNilai'));
    }
    

    // ============================
    // UPDATE DATA
    // ============================

    // Update Tahun Akademik
    public function updateTahunAkademik(Request $request, $id)
{
    // Validasi data yang masuk
    $request->validate([
        'tahun' => 'required|string|max:255',
        'semester' => 'required|string|max:255',
        'kurikulum' => 'required|string|max:255',
    ]);

    // Cari data tahun akademik berdasarkan ID
    $tahunAkademik = TahunAkademik::findOrFail($id);

    // Update data tahun akademik
    $tahunAkademik->tahun = $request->input('tahun');
    $tahunAkademik->semester = $request->input('semester');
    $tahunAkademik->kurikulum = $request->input('kurikulum');
    $tahunAkademik->save();

    // Redirect kembali ke dashboard dengan pesan sukses
    return redirect()->route('dashboard')->with('success', 'Tahun Akademik berhasil diupdate.');
}

public function update(Request $request, $type, $id)
{
    if ($type === 'programStudi') {
        $data = $request->only(['kode_prodi', 'nama_prodi', 'nama_kaprodi']);
        ProgramStudi::where('id', $id)->update($data);
    }

    if ($type === 'rangeNilai') {
        $data = $request->only(['dari', 'hingga', 'hasil']);
        RangeNilai::where('id', $id)->update($data);
    }

    return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui!');
}
}