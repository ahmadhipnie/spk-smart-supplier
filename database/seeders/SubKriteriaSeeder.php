<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKriteriaSeeder extends Seeder
{
    public function run()
    {
        $subKriteria = [
            // Sub Kriteria untuk Harga (C1) - Cost
            ['kriteria_id' => 1, 'nama_sub_kriteria' => '< Rp 5.000.000', 'nilai' => 100, 'keterangan' => 'Sangat Murah'],
            ['kriteria_id' => 1, 'nama_sub_kriteria' => 'Rp 5.000.000 - Rp 7.000.000', 'nilai' => 75, 'keterangan' => 'Murah'],
            ['kriteria_id' => 1, 'nama_sub_kriteria' => 'Rp 7.000.001 - Rp 10.000.000', 'nilai' => 50, 'keterangan' => 'Cukup Mahal'],
            ['kriteria_id' => 1, 'nama_sub_kriteria' => '> Rp 10.000.000', 'nilai' => 25, 'keterangan' => 'Mahal'],
            
            // Sub Kriteria untuk Kualitas Barang (C2) - Benefit
            ['kriteria_id' => 2, 'nama_sub_kriteria' => 'Sangat Baik', 'nilai' => 100, 'keterangan' => 'Kualitas premium'],
            ['kriteria_id' => 2, 'nama_sub_kriteria' => 'Baik', 'nilai' => 75, 'keterangan' => 'Kualitas standar tinggi'],
            ['kriteria_id' => 2, 'nama_sub_kriteria' => 'Cukup', 'nilai' => 50, 'keterangan' => 'Kualitas standar'],
            ['kriteria_id' => 2, 'nama_sub_kriteria' => 'Kurang', 'nilai' => 25, 'keterangan' => 'Kualitas di bawah standar'],
            
            // Sub Kriteria untuk Pelayanan (C3) - Benefit
            ['kriteria_id' => 3, 'nama_sub_kriteria' => 'Sangat Responsif', 'nilai' => 100, 'keterangan' => 'Respon < 1 jam'],
            ['kriteria_id' => 3, 'nama_sub_kriteria' => 'Responsif', 'nilai' => 75, 'keterangan' => 'Respon 1-4 jam'],
            ['kriteria_id' => 3, 'nama_sub_kriteria' => 'Cukup Responsif', 'nilai' => 50, 'keterangan' => 'Respon 4-24 jam'],
            ['kriteria_id' => 3, 'nama_sub_kriteria' => 'Lambat', 'nilai' => 25, 'keterangan' => 'Respon > 24 jam'],
            
            // Sub Kriteria untuk Pengiriman (C4) - Benefit
            ['kriteria_id' => 4, 'nama_sub_kriteria' => 'Sangat Cepat (1-2 hari)', 'nilai' => 100, 'keterangan' => 'Pengiriman express'],
            ['kriteria_id' => 4, 'nama_sub_kriteria' => 'Cepat (3-5 hari)', 'nilai' => 75, 'keterangan' => 'Pengiriman reguler cepat'],
            ['kriteria_id' => 4, 'nama_sub_kriteria' => 'Normal (6-7 hari)', 'nilai' => 50, 'keterangan' => 'Pengiriman standar'],
            ['kriteria_id' => 4, 'nama_sub_kriteria' => 'Lambat (> 7 hari)', 'nilai' => 25, 'keterangan' => 'Pengiriman lambat'],
            
            // Sub Kriteria untuk Garansi (C5) - Benefit
            ['kriteria_id' => 5, 'nama_sub_kriteria' => '> 2 Tahun', 'nilai' => 100, 'keterangan' => 'Garansi panjang'],
            ['kriteria_id' => 5, 'nama_sub_kriteria' => '1-2 Tahun', 'nilai' => 75, 'keterangan' => 'Garansi standar'],
            ['kriteria_id' => 5, 'nama_sub_kriteria' => '6-12 Bulan', 'nilai' => 50, 'keterangan' => 'Garansi terbatas'],
            ['kriteria_id' => 5, 'nama_sub_kriteria' => '< 6 Bulan', 'nilai' => 25, 'keterangan' => 'Garansi minimal'],
        ];

        foreach ($subKriteria as $item) {
            DB::table('sub_kriteria')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}
