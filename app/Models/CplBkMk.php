<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CplBkMk extends Model
{
    use HasFactory;

    protected $table = 'cpl_bk_mk'; // Nama tabel di database

    protected $fillable = [
        'kode_cpl',
        'kode',
        'kode_mk',
        'status'
    ];

    // Relasi ke tabel CPL
    public function cpl()
    {
        return $this->belongsTo(CplProdi::class, 'kode_cpl', 'kode_cpl');
    }

    // Relasi ke tabel BK
    public function bk()
    {
        return $this->belongsTo(BahanKajian::class, 'kode', 'kode');
    }

    // Relasi ke tabel MK
    public function mk()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
    }
}
