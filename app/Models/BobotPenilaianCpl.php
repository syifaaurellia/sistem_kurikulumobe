<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotPenilaianCpl extends Model
{
    use HasFactory;
    
    protected $table = 'bobot_penilaian_cpl';
    
    protected $fillable = [
        'penilaian_id',
        'quiz_tugas',
        'observasi_praktek',
        'unjuk_kerja',
        'uts',
        'uas',
        'tugas_kelompok'
    ];

    // Relasi ke tabel Penilaian
    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class, 'penilaian_id');
    }

    // Total Bobot otomatis
    public function getTotalAttribute()
    {
        return $this->quiz_tugas + $this->observasi_praktek + $this->unjuk_kerja + 
               $this->uts + $this->uas + $this->tugas_kelompok;
    }
}
