<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotPenilaian extends Model
{
    use HasFactory;
    protected $table = 'bobot_penilaian';
    protected $fillable = [
        'id_pemetaan_cpl_mk_cpmk',
        'quiz_tugas',
        'observasi_praktek',
        'unjuk_kerja',
        'uts',
        'uas',
        'tugas_kelompok'
    ];

    // Relasi ke PemetaanCplMkCpmk
    public function pemetaan()
    {
        return $this->belongsTo(PemetaanCplMkCpmk::class, 'id_pemetaan_cpl_mk_cpmk');
    }

    // Relasi ke Mata Kuliah melalui PemetaanCplMkCpmk
    public function mataKuliah()
    {
        return $this->hasOneThrough(
            MataKuliah::class, // Model tujuan akhir
            PemetaanCplMkCpmk::class, // Model perantara
            'id', // Kunci utama di PemetaanCplMkCpmk
            'id', // Kunci utama di Mata Kuliah
            'id_pemetaan_cpl_mk_cpmk', // Kunci asing di BobotPenilaian yang mengarah ke PemetaanCplMkCpmk
            'mata_kuliah_id' // Kunci asing di PemetaanCplMkCpmk yang mengarah ke Mata Kuliah
        );
    }

    // Relasi ke CPL melalui PemetaanCplMkCpmk
    public function cpl()
    {
        return $this->hasOneThrough(
            CplProdi::class,
            PemetaanCplMkCpmk::class,
            'id',
            'id',
            'id_pemetaan_cpl_mk_cpmk',
            'cpl_id'
        );
    }

    // Relasi ke CPMK melalui PemetaanCplMkCpmk
    public function cpmk()
    {
        return $this->hasOneThrough(
            Cpmk::class,
            PemetaanCplMkCpmk::class,
            'id',
            'id',
            'id_pemetaan_cpl_mk_cpmk',
            'cpmk_id'
        );
    }

    // Perhitungan total bobot
    public function getTotalAttribute()
    {
        return $this->quiz + $this->observasi + $this->unjuk_kerja + $this->uts + $this->uas + $this->tugas_kelompok;
    }
}
