<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CplProdi extends Model
{
    protected $table = 'cpl_prodi';
    protected $fillable = ['kode_cpl', 'deskripsi_cpl'];

    // Relasi ke CplPl
    public function cplPl()
    {
        return $this->hasMany(CplPl::class, 'kode_cpl', 'kode_cpl');
    }
    
}
