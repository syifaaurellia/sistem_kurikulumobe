<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studis';
    protected $fillable = ['nama_prodi', 'kode_prodi', 'nama_kaprodi'];
}
