<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemenuhanCPL;
use App\Models\CPLProdi;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;

class PemenuhanCPLController extends Controller
{
    public function index()
    {
        $pemenuhanCPL = PemenuhanCPL::with(['cpl', 'mataKuliah'])->get()->groupBy('cpl_id');
        return view('pemenuhan-cpl.index', compact('pemenuhanCPL'));
    }

    public function create()
    {
        $cplList = CPLProdi::all();
        $mataKuliahList = MataKuliah::all();
        return view('pemenuhan-cpl.create', compact('cplList', 'mataKuliahList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cpl_id' => 'required',
            'mata_kuliah_id' => 'required|array',
            'semester' => 'required|array',
        ]);

        if (count($request->mata_kuliah_id) !== count($request->semester)) {
            return back()->with('error', 'Jumlah mata kuliah dan semester tidak sesuai.');
        }

        foreach ($request->mata_kuliah_id as $index => $mk_id) {
            $exists = PemenuhanCPL::where([
                'cpl_id' => $request->cpl_id,
                'mata_kuliah_id' => $mk_id,
                'semester' => $request->semester[$index],
            ])->exists();

            if (!$exists) {
                PemenuhanCPL::create([
                    'cpl_id' => $request->cpl_id,
                    'mata_kuliah_id' => $mk_id,
                    'semester' => $request->semester[$index],
                ]);
            }
        }

        return redirect()->route('pemenuhan-cpl.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pemenuhanCPL = PemenuhanCPL::with(['cpl', 'mataKuliah'])->where('cpl_id', $id)->get();
        $cplList = CPLProdi::all();
        $mataKuliahList = MataKuliah::all();

        if ($pemenuhanCPL->isEmpty()) {
            return redirect()->route('pemenuhan-cpl.index')->with('error', 'Data tidak ditemukan!');
        }

        return view('pemenuhan-cpl.edit', compact('pemenuhanCPL', 'cplList', 'mataKuliahList'));
    }

    public function update(Request $request, $cpl_id)
    {
        $request->validate([
            'cpl_id' => 'required',
            'mata_kuliah_id' => 'required|array',
            'semester' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            PemenuhanCPL::where('cpl_id', $cpl_id)->delete();

            foreach ($request->mata_kuliah_id as $index => $mk_id) {
                PemenuhanCPL::create([
                    'cpl_id' => $request->cpl_id,
                    'mata_kuliah_id' => $mk_id,
                    'semester' => $request->semester[$index],
                ]);
            }

            DB::commit();
            return redirect()->route('pemenuhan-cpl.index')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pemenuhan-cpl.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
{
    $pemenuhanCPL = PemenuhanCPL::findOrFail($id);
    $pemenuhanCPL->delete();

    return redirect()->route('pemenuhan-cpl.index')->with('success', 'Data berhasil dihapus');
}
}
