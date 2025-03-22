<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RangeNilai extends Model
{
    protected $table = 'range_nilais';
    protected $fillable = ['dari', 'hingga', 'hasil'];
}
