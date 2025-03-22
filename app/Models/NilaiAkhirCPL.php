<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAkhirCPL extends Model
{
    use HasFactory;

    protected $table = 'nilai_akhir_cpl';
    protected $fillable = ['cpl_id', 'total_skor'];

    // Relasi ke CPL
    public function cpl()
    {
        return $this->belongsTo(CPLProdi::class, 'cpl_id');
    }
}
