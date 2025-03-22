<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiMataKuliah extends Model
{
    use HasFactory;

    protected $table = 'organisasi_mata_kuliah';
    protected $fillable = ['semester', 'total_sks', 'jumlah_mk'];

    public function mkWajib()
    {
        return $this->hasMany(OrganisasiMkWajib::class, 'organisasi_id');
    }

    public function mkPilihan()
    {
        return $this->hasMany(OrganisasiMkPilihan::class, 'organisasi_id');
    }

    public function mkwu()
    {
        return $this->hasMany(OrganisasiMkwu::class, 'organisasi_id');
    }
}
