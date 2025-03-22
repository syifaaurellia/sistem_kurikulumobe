<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BobotPenilaianCPL;
use App\Models\CPL;

class NilaiAkhirCPLController extends Controller
{
    public function index()
    {
        // Mengambil data bobot penilaian dengan relasi ke CPL
        $nilaiAkhir = BobotPenilaianCPL::with(['penilaian.cpl', 'penilaian.mataKuliah', 'penilaian.cpmk'])
            ->get()
            ->groupBy('penilaian.cpl.id'); // Grup berdasarkan CPL

        return view('nilai_akhir_cpl.index', compact('nilaiAkhir'));
    }
}
