<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifSeeder extends Seeder
{
    public function run()
    {
        $alternatif = [
            [
                'kode_alternatif' => 'A1',
                'nama_supplier' => 'PT Sentosa Jaya',
                'alamat' => 'Jl. Raya Industri No. 123, Jakarta',
                'telepon' => '021-1234567',
                'email' => 'info@sentosajaya.com',
                'keterangan' => 'Supplier elektronik terpercaya',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A2',
                'nama_supplier' => 'CV Mitra Usaha',
                'alamat' => 'Jl. Perdagangan No. 45, Surabaya',
                'telepon' => '031-9876543',
                'email' => 'contact@mitrausaha.co.id',
                'keterangan' => 'Supplier komponen industri',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A3',
                'nama_supplier' => 'UD Berkah Abadi',
                'alamat' => 'Jl. Pasar Baru No. 78, Bandung',
                'telepon' => '022-5551234',
                'email' => 'berkah@gmail.com',
                'keterangan' => 'Supplier material bangunan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A4',
                'nama_supplier' => 'PT Sejahtera Makmur',
                'alamat' => 'Jl. Industri Raya No. 99, Semarang',
                'telepon' => '024-7778888',
                'email' => 'sejahtera@sejahtera.com',
                'keterangan' => 'Supplier bahan kimia',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A5',
                'nama_supplier' => 'CV Mandiri Jaya',
                'alamat' => 'Jl. Perdagangan No. 55, Yogyakarta',
                'telepon' => '0274-123456',
                'email' => 'mandiri@mandirijaya.id',
                'keterangan' => 'Supplier alat kesehatan',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('alternatif')->insert($alternatif);
    }
}
