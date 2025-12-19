<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [
            [
                'kode_supplier' => 'SUP001',
                'nama_supplier' => 'PT Sentosa Jaya',
                'nama_perusahaan' => 'Sentosa Jaya Group',
                'alamat' => 'Jl. Raya Industri No. 123',
                'kota' => 'Jakarta',
                'telepon' => '021-1234567',
                'email' => 'info@sentosajaya.com',
                'kontak_person' => 'Budi Santoso',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_supplier' => 'SUP002',
                'nama_supplier' => 'CV Mitra Usaha',
                'nama_perusahaan' => 'Mitra Usaha Indonesia',
                'alamat' => 'Jl. Perdagangan No. 45',
                'kota' => 'Surabaya',
                'telepon' => '031-9876543',
                'email' => 'contact@mitrausaha.co.id',
                'kontak_person' => 'Siti Aminah',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_supplier' => 'SUP003',
                'nama_supplier' => 'UD Berkah Abadi',
                'nama_perusahaan' => null,
                'alamat' => 'Jl. Pasar Baru No. 78',
                'kota' => 'Bandung',
                'telepon' => '022-5551234',
                'email' => 'berkah@gmail.com',
                'kontak_person' => 'Ahmad Fauzi',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('suppliers')->insert($suppliers);
    }
}
