<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilLulusan extends Model
{
    protected $table = 'profil_lulusan';
    protected $fillable = ['kode_pl', 'profil_lulusan', 'profesi'];
}

