<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MkCpmk extends Model
{
    use HasFactory;
    protected $table = 'mk_cpmks';
    protected $fillable = ['kode_mk', 'kode_cpmk'];
}
