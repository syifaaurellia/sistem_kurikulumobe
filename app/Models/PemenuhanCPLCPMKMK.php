<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemenuhanCPLCPMKMK extends Model
{
    use HasFactory;

    protected $table = 'pemenuhan_cpl_cpmk_mk';

    protected $fillable = [
        'cpl_id',
        'cpmk_id',
        'mata_kuliah_id',
        'semester'
    ];

    public function cpl()
    {
        return $this->belongsTo(CPLProdi::class, 'cpl_id');
    }

    public function cpmk()
    {
        return $this->belongsTo(CPMK::class, 'cpmk_id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}
