<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemetaanCPLMKCPMK extends Model
{
    use HasFactory;

    protected $table = 'pemetaan_cpl_mk_cpmk';
    protected $fillable = ['mata_kuliah_id', 'cpl_id', 'cpmk_id'];


    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function cpl()
    {
        return $this->belongsTo(CPLProdi::class, 'cpl_id'); // Pastikan nama model benar
    }

    public function cpmk()
    {
        return $this->belongsTo(CPMK::class, 'cpmk_id');
    }
}
