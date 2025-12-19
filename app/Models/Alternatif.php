<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';
    
    protected $fillable = [
        'kode_alternatif',
        'nama_supplier',
        'alamat',
        'telepon',
        'email',
        'keterangan'
    ];

    // Relasi ke penilaian
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'alternatif_id');
    }

    // Relasi ke perhitungan
    public function perhitungan()
    {
        return $this->hasMany(Perhitungan::class, 'alternatif_id');
    }

    // Relasi ke hasil akhir
    public function hasilAkhir()
    {
        return $this->hasOne(HasilAkhir::class, 'alternatif_id');
    }
}
