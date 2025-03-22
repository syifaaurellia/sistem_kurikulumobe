<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPMK extends Model
{
    use HasFactory;

    protected $table = 'cpmk'; // Pastikan ini sesuai dengan nama tabel

    protected $fillable = ['kode_cpmk', 'deskripsi_cpmk'];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'cpmk_id');
    }
}
