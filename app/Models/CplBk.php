<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CplBk extends Model
{
    protected $table = 'cpl_bk';
    protected $fillable = ['kode_cpl', 'kode', 'status'];

    public function cplProdi()
    {
        return $this->belongsTo(CplProdi::class, 'kode_cpl', 'kode_cpl');
    }

    public function bk()
    {
        // Sesuaikan dengan foreign key 'kode' yang digunakan di cpl_bk
        return $this->belongsTo(BahanKajian::class, 'kode', 'kode');
    }
}
