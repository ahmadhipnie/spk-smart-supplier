<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    use HasFactory;

    protected $table = 'perhitungan';
    
    protected $fillable = [
        'alternatif_id',
        'kriteria_id',
        'nilai_utility',
        'bobot_kriteria',
        'nilai_akhir'
    ];

    // Relasi ke alternatif
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id');
    }

    // Relasi ke kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
