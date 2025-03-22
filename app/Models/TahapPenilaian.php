<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahapPenilaian extends Model
{
    use HasFactory;

    protected $table = 'tahap_penilaian';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'penilaian_id',
        'tahap_penilaian',
        'teknik_penilaian',
        'instrumen',
        'kriteria',
        'bobot'
    ];

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class, 'penilaian_id', 'id');
    }

    // Ambil data CPL dari tabel Penilaian
    public function cpl()
    {
        return $this->hasOneThrough(
            CplProdi::class,    // Model yang ingin diakses
            Penilaian::class,   // Model perantara
            'id',               // Kunci primer di tabel Penilaian
            'id',               // Kunci primer di tabel CPL
            'penilaian_id',     // Foreign key di TahapPenilaian ke Penilaian
            'cpl_id'            // Foreign key di Penilaian ke CPL
        );
    }

    // Ambil data Mata Kuliah dari tabel Penilaian
    public function mataKuliah()
    {
        return $this->hasOneThrough(
            MataKuliah::class,
            Penilaian::class,
            'id',
            'id',
            'penilaian_id',
            'mk_id'
        );
    }

    // Ambil data CPMK dari tabel Penilaian
    public function cpmk()
    {
        return $this->hasOneThrough(
            CPMK::class,
            Penilaian::class,
            'id',
            'id',
            'penilaian_id',
            'cpmk_id'
        );
    }
}
