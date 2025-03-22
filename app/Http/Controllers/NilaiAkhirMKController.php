<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BobotPenilaian;
use App\Models\MataKuliah;

class NilaiAkhirMKController extends Controller
{
    public function index()
    {
        // Mengambil data bobot penilaian beserta relasi
        $nilaiAkhir = BobotPenilaian::with(['pemetaan.mataKuliah', 'pemetaan.cpl', 'pemetaan.cpmk'])
            ->get()
            ->groupBy('pemetaan.mataKuliah.id'); // Grup berdasarkan MK

        return view('nilai_akhir.index', compact('nilaiAkhir'));
    }
}
