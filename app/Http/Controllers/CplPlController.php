<?php

namespace App\Http\Controllers;

use App\Models\CplPl;
use App\Models\CplProdi;
use App\Models\Pl;
use App\Models\ProfilLulusan;
use Illuminate\Http\Request;

class CplPlController extends Controller
{
    public function index()
    {
        $cplPl = CplPl::with(['cplProdi', 'pl'])->get();
        return view('cpl-pl.index', compact('cplPl'));
    }

    public function create()
    {
        $cpl = CplProdi::all();
        $pl = ProfilLulusan::all();
        return view('cpl-pl.create', compact('cpl', 'pl'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_cpl' => 'required',
            'kode_pl' => 'required',
        ]);

        CplPl::create($request->all());
        return redirect()->route('cpl-pl.index')->with('success', 'Relasi CPL-PL berhasil ditambahkan.');
    }

    public function edit($id)
{
    $cplPl = CplPl::findOrFail($id);
    $cplProdi = CplProdi::all(); // Ganti dari $cpl ke $cplProdi
    $profilLulusan = ProfilLulusan::all(); // Ganti dari $pl ke $profilLulusan
    return view('cpl-pl.edit', compact('cplPl', 'cplProdi', 'profilLulusan'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_cpl' => 'required',
            'kode_pl' => 'required',
        ]);

        $cplPl = CplPl::findOrFail($id);
        $cplPl->update($request->all());

        return redirect()->route('cpl-pl.index')->with('success', 'Relasi CPL-PL berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $cplPl = CplPl::findOrFail($id);
        $cplPl->delete();

        return redirect()->route('cpl-pl.index')->with('success', 'Relasi CPL-PL berhasil dihapus.');
    }
}
