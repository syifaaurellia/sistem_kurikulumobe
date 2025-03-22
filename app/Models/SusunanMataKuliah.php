<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SusunanMataKuliah extends Model
{
    use HasFactory;

    protected $table = 'susunan_mata_kuliah';
    protected $fillable = [
        'mata_kuliah_id', 'semester_1', 'semester_2', 'semester_3',
        'semester_4', 'semester_5', 'semester_6', 'semester_7', 'semester_8'
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}
