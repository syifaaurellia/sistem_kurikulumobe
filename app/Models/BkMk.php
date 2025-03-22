<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BkMk extends Model
{
    protected $table = 'bk_mk';
    protected $fillable = ['kode', 'kode_mk'];

    public function bk()
    {
        return $this->belongsTo(BahanKajian::class, 'kode', 'kode');
    }

    public function mk()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
    }
}
