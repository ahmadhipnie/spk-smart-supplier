<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilAkhir extends Model
{
    use HasFactory;

    protected $table = 'hasil_akhir';
    
    protected $fillable = [
        'alternatif_id',
        'total_nilai',
        'ranking',
        'tanggal_perhitungan'
    ];

    protected $casts = [
        'tanggal_perhitungan' => 'date'
    ];

    // Relasi ke alternatif
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id');
    }
}
