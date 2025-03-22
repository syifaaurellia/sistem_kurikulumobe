<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemetaanMKCPMKSubCPMK extends Model
{
    use HasFactory;

    protected $table = 'pemetaan_mk_cpmk_subcpmk';

    protected $fillable = ['mata_kuliah_id', 'cpmk_id', 'sub_cpmk_id'];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function cpmk()
    {
        return $this->belongsTo(CPMK::class, 'cpmk_id');
    }

    public function subCpmk()
    {
        return $this->belongsTo(SubCPMK::class, 'sub_cpmk_id');
    }
}
