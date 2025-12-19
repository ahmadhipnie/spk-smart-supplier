<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        $kriteria = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Harga',
                'jenis_kriteria' => 'cost',
                'bobot' => 25.00,
                'keterangan' => 'Harga produk yang ditawarkan supplier',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Kualitas Barang',
                'jenis_kriteria' => 'benefit',
                'bobot' => 30.00,
                'keterangan' => 'Kualitas produk dari supplier',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Pelayanan',
                'jenis_kriteria' => 'benefit',
                'bobot' => 20.00,
                'keterangan' => 'Kualitas pelayanan supplier',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Pengiriman',
                'jenis_kriteria' => 'benefit',
                'bobot' => 15.00,
                'keterangan' => 'Ketepatan waktu pengiriman barang',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_kriteria' => 'Garansi',
                'jenis_kriteria' => 'benefit',
                'bobot' => 10.00,
                'keterangan' => 'Layanan garansi produk',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('kriteria')->insert($kriteria);
    }
}
