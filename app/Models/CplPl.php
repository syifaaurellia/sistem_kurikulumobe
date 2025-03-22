<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CplPl extends Model
{
    protected $table = 'cpl_pl';
    protected $fillable = ['kode_cpl', 'kode_pl', 'status'];
    public $timestamps = false;

    // Relasi ke tabel cpl_prodi
    public function cplProdi()
    {
        return $this->belongsTo(CplProdi::class, 'kode_cpl', 'kode_cpl');
    }

    // Relasi ke tabel pl
    public function pl()
{
    return $this->belongsTo(ProfilLulusan::class, 'kode_pl', 'kode_pl')->withDefault([
        'kode_pl' => 'N/A',
        'profil_lulusan' => 'Tidak Tersedia'
    ]);
}
}
