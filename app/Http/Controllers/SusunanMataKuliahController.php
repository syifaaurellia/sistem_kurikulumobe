<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\SusunanMataKuliah;
use Illuminate\Http\Request;

class SusunanMataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::all();
        $susunanMataKuliah = SusunanMataKuliah::with('mataKuliah')->get();

        return view('susunan_mata_kuliah.index', compact('mataKuliah', 'susunanMataKuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|array',  // Pastikan ada array mata kuliah
            'mata_kuliah_id.*' => 'exists:mata_kuliah,id',
        ]);
    
        foreach ($request->mata_kuliah_id as $mk_id) {
            SusunanMataKuliah::updateOrCreate(
                ['mata_kuliah_id' => $mk_id],
                [
                    'semester_1' => $request->has("semester_1.$mk_id"),
                    'semester_2' => $request->has("semester_2.$mk_id"),
                    'semester_3' => $request->has("semester_3.$mk_id"),
                    'semester_4' => $request->has("semester_4.$mk_id"),
                    'semester_5' => $request->has("semester_5.$mk_id"),
                    'semester_6' => $request->has("semester_6.$mk_id"),
                    'semester_7' => $request->has("semester_7.$mk_id"),
                    'semester_8' => $request->has("semester_8.$mk_id"),
                ]
            );
        }
    
        return redirect()->route('susunan_mata_kuliah.index')->with('success', 'Data berhasil disimpan!');
    }
    
}

