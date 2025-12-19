<!DOCTYPE html>
<html>
<head>
    <title>Laporan Hasil SMART</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2, h3 { text-align: center; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-center { text-align: center; }
        .badge { padding: 3px 8px; background: #007bff; color: white; border-radius: 3px; }
        .badge-success { background: #28a745; }
        .header { margin-bottom: 20px; }
        .footer { margin-top: 30px; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN HASIL AKHIR</h2>
        <h3>Pemilihan Supplier Terbaik Menggunakan Metode SMART</h3>
        <p class="text-center">Tanggal: {{ $tanggal }}</p>
    </div>

    <h4>Ranking Supplier:</h4>
    <table>
        <thead>
            <tr>
                <th width="10%" class="text-center">Ranking</th>
                <th width="15%">Kode</th>
                <th width="40%">Nama Supplier</th>
                <th width="20%" class="text-center">Total Nilai SMART</th>
                <th width="15%" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasilAkhir as $hasil)
            <tr>
                <td class="text-center"><strong>#{{ $hasil->ranking }}</strong></td>
                <td>{{ $hasil->alternatif->kode_alternatif }}</td>
                <td>
                    <strong>{{ $hasil->alternatif->nama_supplier }}</strong>
                    @if($hasil->ranking == 1) <span class="badge badge-success">TERBAIK</span> @endif
                </td>
                <td class="text-center">{{ number_format($hasil->total_nilai, 4) }}</td>
                <td class="text-center">
                    @if($hasil->ranking <= 3) Direkomendasikan @else Standar @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px; padding: 15px; background: #f8f9fa; border: 1px solid #ddd;">
        <h4>Kesimpulan:</h4>
        <p>
            Berdasarkan perhitungan metode SMART dengan mempertimbangkan {{ $kriteria->count() }} kriteria 
            ({{ $kriteria->pluck('nama_kriteria')->implode(', ') }}), 
            supplier terbaik adalah <strong>{{ $hasilAkhir->first()->alternatif->nama_supplier }}</strong> 
            dengan total nilai SMART sebesar <strong>{{ number_format($hasilAkhir->first()->total_nilai, 4) }}</strong>.
        </p>
    </div>

    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis oleh Sistem Pendukung Keputusan Pemilihan Supplier</p>
        <p>Tanggal Cetak: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
