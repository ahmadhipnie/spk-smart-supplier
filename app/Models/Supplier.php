<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    
    protected $fillable = [
        'kode_supplier',
        'nama_supplier',
        'nama_perusahaan',
        'alamat',
        'kota',
        'telepon',
        'email',
        'kontak_person',
        'keterangan',
        'status'
    ];

    // Relasi ke alternatif (jika supplier juga sebagai alternatif)
    public function alternatif()
    {
        return $this->hasOne(Alternatif::class, 'supplier_id');
    }
}
