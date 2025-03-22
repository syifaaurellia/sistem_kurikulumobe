<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CplCpmkMk extends Model
{
    use HasFactory;

    protected $table = 'cpl_cpmk_mk';
    protected $fillable = ['cpl_id', 'cpmk_id', 'mata_kuliah_id'];

    public function cpl()
    {
        return $this->belongsTo(CplProdi::class, 'cpl_id');
    }

    public function cpmk()
    {
        return $this->belongsTo(Cpmk::class, 'cpmk_id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}
