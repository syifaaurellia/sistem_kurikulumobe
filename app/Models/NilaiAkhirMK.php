<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAkhirMK extends Model
{
    use HasFactory;

    protected $table = 'nilai_akhir_mk';
    protected $fillable = ['mata_kuliah_id', 'total_skor'];

    // Relasi ke Mata Kuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}
