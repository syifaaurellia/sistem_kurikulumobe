<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CplMk extends Model
{
    use HasFactory;

    protected $table = 'cpl_mk';
    protected $fillable = ['kode_cpl', 'kode_mk', 'status'];

    // Relasi ke model CplProdi
    public function cplProdi()
    {
        return $this->belongsTo(CplProdi::class, 'kode_cpl', 'kode_cpl');
    }

    // Relasi ke model MataKuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
    }
}



