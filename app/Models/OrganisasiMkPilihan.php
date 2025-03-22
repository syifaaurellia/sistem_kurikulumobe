<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiMkPilihan extends Model
{
    use HasFactory;

    protected $table = 'organisasi_mk_pilihan';
    protected $fillable = ['organisasi_id', 'mata_kuliah_id'];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}
