<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganisasiMataKuliah;
use App\Models\OrganisasiMkWajib;
use App\Models\OrganisasiMkPilihan;
use App\Models\OrganisasiMkwu;
use App\Models\MataKuliah;

class OrganisasiMataKuliahController extends Controller
{
    public function index()
    {
        $data = OrganisasiMataKuliah::with(['mkWajib.mataKuliah', 'mkPilihan.mataKuliah', 'mkwu.mataKuliah'])->get();
        return view('organisasi_mata_kuliah.index', compact('data'));
    }

    public function create()
    {
        $mataKuliah = MataKuliah::all();
        return view('organisasi_mata_kuliah.create', compact('mataKuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required|string|max:10',
            'mk_wajib' => 'array',
            'mk_pilihan' => 'nullable|integer|exists:mata_kuliah,id',
            'mkwu' => 'nullable|integer|exists:mata_kuliah,id',
        ]);

        $totalSks = 0;
        $jumlahMk = 0;

        if (!empty($request->mk_wajib)) {
            $jumlahMk += count($request->mk_wajib);
            $totalSks += MataKuliah::whereIn('id', $request->mk_wajib)->sum('sks');
        }

        if (!empty($request->mk_pilihan)) {
            $jumlahMk += 1;
            $totalSks += MataKuliah::find($request->mk_pilihan)->sks;
        }

        if (!empty($request->mkwu)) {
            $jumlahMk += 1;
            $totalSks += MataKuliah::find($request->mkwu)->sks;
        }

        $organisasi = OrganisasiMataKuliah::create([
            'semester' => $request->semester,
            'total_sks' => $totalSks,
            'jumlah_mk' => $jumlahMk
        ]);

        if (!empty($request->mk_wajib)) {
            foreach ($request->mk_wajib as $mk_id) {
                OrganisasiMkWajib::create([
                    'organisasi_id' => $organisasi->id,
                    'mata_kuliah_id' => $mk_id
                ]);
            }
        }

        if (!empty($request->mk_pilihan)) {
            OrganisasiMkPilihan::create([
                'organisasi_id' => $organisasi->id,
                'mata_kuliah_id' => $request->mk_pilihan
            ]);
        }

        if (!empty($request->mkwu)) {
            OrganisasiMkwu::create([
                'organisasi_id' => $organisasi->id,
                'mata_kuliah_id' => $request->mkwu
            ]);
        }

        return redirect()->route('organisasi.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
{
    $organisasi = OrganisasiMataKuliah::with(['mkWajib', 'mkPilihan', 'mkwu'])->findOrFail($id);
    $mataKuliah = MataKuliah::all(); // Ambil semua data Mata Kuliah

    return view('organisasi_mata_kuliah.edit', compact('organisasi', 'mataKuliah'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'semester' => 'required|string|max:10',
        'mk_wajib' => 'array',
        'mk_pilihan' => 'nullable|integer|exists:mata_kuliah,id',
        'mkwu' => 'nullable|integer|exists:mata_kuliah,id',
    ]);

    $organisasi = OrganisasiMataKuliah::findOrFail($id);

    // Hapus data lama
    OrganisasiMkWajib::where('organisasi_id', $id)->delete();
    OrganisasiMkPilihan::where('organisasi_id', $id)->delete();
    OrganisasiMkwu::where('organisasi_id', $id)->delete();

    // Hitung ulang total SKS dan jumlah MK
    $totalSks = 0;
    $jumlahMk = 0;

    if (!empty($request->mk_wajib)) {
        foreach ($request->mk_wajib as $mkId) {
            OrganisasiMkWajib::create([
                'organisasi_id' => $id,
                'mata_kuliah_id' => $mkId
            ]);
        }
        $jumlahMk += count($request->mk_wajib);
        $totalSks += MataKuliah::whereIn('id', $request->mk_wajib)->sum('sks');
    }

    if (!empty($request->mk_pilihan)) {
        OrganisasiMkPilihan::create([
            'organisasi_id' => $id,
            'mata_kuliah_id' => $request->mk_pilihan
        ]);
        $jumlahMk += 1;
        $totalSks += MataKuliah::find($request->mk_pilihan)->sks;
    }

    if (!empty($request->mkwu)) {
        OrganisasiMkwu::create([
            'organisasi_id' => $id,
            'mata_kuliah_id' => $request->mkwu
        ]);
        $jumlahMk += 1;
        $totalSks += MataKuliah::find($request->mkwu)->sks;
    }

    $organisasi->update([
        'semester' => $request->semester,
        'total_sks' => $totalSks,
        'jumlah_mk' => $jumlahMk
    ]);

    return redirect()->route('organisasi.index')->with('success', 'Data berhasil diperbarui');
}

    public function destroy($id)
    {
        OrganisasiMataKuliah::findOrFail($id)->delete();
        return redirect()->route('organisasi.index')->with('success', 'Data berhasil dihapus');
    }
}
