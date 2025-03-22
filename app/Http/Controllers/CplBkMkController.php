<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CplBkMk;
use App\Models\CplProdi;
use App\Models\BahanKajian;
use App\Models\MataKuliah;

class CplBkMkController extends Controller
{
    public function index()
    {
        $data = CplBkMk::with(['cpl', 'bk', 'mk'])->get();
        return view('cpl-bk-mk.index', compact('data'));
    }

    public function create()
    {
        $cplProdi = CplProdi::all();
        $bahanKajian = BahanKajian::all();
        $mataKuliah = MataKuliah::all();
        return view('cpl-bk-mk.create', compact('cplProdi', 'bahanKajian', 'mataKuliah'));
    }

    public function store(Request $request)
{
    // Validasi data jika diperlukan
    $request->validate([
        'kode_cpl' => 'required',
        'kode' => 'required',
        'kode_mk' => 'required',
    ]);

    // Simpan ke database
    $data = new CplBkMk(); // Pastikan ini sesuai dengan model yang digunakan
    $data->kode_cpl = $request->kode_cpl;
    $data->kode = $request->kode;
    $data->kode_mk = $request->kode_mk;
    $data->save();

    return redirect()->route('cpl-bk-mk.index')->with('success', 'Data berhasil disimpan.');
}


public function edit($id)
{
    $cplBkMk = CplBkMk::findOrFail($id);
    $cplProdi = CplProdi::all(); // Ambil semua data CPL Prodi
    $bahanKajian = BahanKajian::all(); // Ambil semua data BK
    $mataKuliah = MataKuliah::all(); // Ambil semua data MK

    return view('cpl-bk-mk.edit', compact('cplBkMk', 'cplProdi', 'bahanKajian', 'mataKuliah'));
}

public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'kode_cpl' => 'required',
        'kode_bk' => 'required',
        'kode_mk' => 'required',
    ]);

    // Cari data berdasarkan ID
    $cplBkMk = CplBkMk::findOrFail($id);

    // Update data
    $cplBkMk->update([
        'kode_cpl' => $request->kode_cpl,
        'kode_bk' => $request->kode_bk,
        'kode_mk' => $request->kode_mk,
    ]);

    // Redirect kembali dengan pesan sukses
    return redirect()->route('cpl-bk-mk.index')->with('success', 'Data berhasil diperbarui');
}


    public function destroy($id)
    {
        CplBkMk::findOrFail($id)->delete();
        return redirect()->route('cpl-bk-mk.index')->with('success', 'Data berhasil dihapus!');
    }
}
