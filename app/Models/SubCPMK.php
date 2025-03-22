<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCPMK extends Model
{
    use HasFactory;

    protected $table = 'sub_cpmk'; // Nama tabel sesuai database

    protected $fillable = ['kode_sub_cpmk', 'uraian_sub_cpmk'];
}
