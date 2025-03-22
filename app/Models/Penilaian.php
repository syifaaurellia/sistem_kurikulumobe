<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';
    protected $fillable = [
        'cpl_id', 'mk_id', 'cpmk_id', 
        'quiz_tugas', 'observasi_praktek', 'unjuk_kerja', 
        'uts', 'uas', 'tugas_kelompok'
    ];

    public function cpl()
    {
        return $this->belongsTo(CplProdi::class, 'cpl_id', 'id')->withDefault();
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mk_id', 'id')->withDefault();
    }

    public function cpmk()
    {
        return $this->belongsTo(CPMK::class, 'cpmk_id', 'id')->withDefault();
    }
}
