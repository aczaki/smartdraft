<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Arsip Surat - IMM Adam Malik</title>
    <style>
        @page { margin: 1cm 1.5cm; }
        
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 14px;
            color: #1f2937;
            line-height: 1.5;
        }

        /* Warna Red-600 Tailwind: #dc2626 */
        .text-red-600 { color: #dc2626; }
        .bg-red-600 { background-color: #dc2626; }
        .border-red-600 { border-color: #dc2626; }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        .w-full { width: 100%; }
        
        /* Kop Surat Styling */
        .header-container {
            padding-bottom: 12px;
            margin-bottom: 20px;
            /* Garis pembatas kop merah red-600 */
            border-bottom: 3px solid #dc2626; 
        }
        .brand-title {
            color: #dc2626; /* Judul kop merah red-600 */
            font-size: 20px;
            margin: 0;
            padding: 0;
            letter-spacing: 1px;
        }
        .address-box {
            font-size: 10px;
            color: #374151;
            margin-top: 5px;
            line-height: 1.3;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            /* Table head merah red-600 */
            background-color: #dc2626; 
            color: white;
            text-transform: uppercase;
            font-size: 10px;
            padding: 10px;
            border: 1px solid #b91c1c;
        }
        td {
            padding: 8px;
            border: 1px solid #e5e7eb;
            font-size: 10px;
            vertical-align: top;
            word-wrap: break-word;
        }
        .stripe:nth-child(even) {
            background-color: #fef2f2; /* red-50 */
        }

        .footer {
            position: fixed;
            bottom: -10px;
            width: 100%;
            font-size: 9px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 5px;
        }
    </style>
</head>
<body>

    <div class="header-container text-center">
        <h1 class="brand-title font-bold uppercase">Pimpinan Komisariat</h1>
        <h1 class="brand-title font-bold uppercase">Ikatan Mahasiswa Muhammadiyah</h1>
        <h1 class="brand-title font-bold uppercase">Adam Malik Fakultas Komunikasi dan Informatika</h1>
        <h1 class="brand-title font-bold uppercase">Universitas Muhammadiyah Surakarta</h1>
        <h1 class="brand-title font-bold uppercase">Cabang Kota Surakarta</h1>
        <!-- <h1 style="margin-top: -5px; font-size: 18px; color: #dc2626;" class="uppercase font-bold">Adam Malik FKI UMS</h1> -->
        <div class="address-box">
            Gedung J Lantai 3 Syp. Utara Kampus 2 UMS, Jl. Ahmad Yani Tromol Pos 1, Pabelan, Kartasura, Surakarta, 57169 <br>
            <span class="font-bold">No. Telp:</span> 0851 6366 5100 | <span class="font-bold">Web:</span> immadammalikfki.wordpress.com | <span class="font-bold">Instagram:</span> @immadammalikfki
        </div>
    </div>

    <div style="margin-bottom: 15px;" class="text-center">
        <h2 class="uppercase font-bold" style="font-size: 15px; margin-bottom: 0; color: #1f2937;">Rekapitulasi Data Arsip Surat</h2>
        <p style="font-size: 11px; color: #6b7280; margin-top: 4px;">Dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
    </div>

    <table class="w-full">
        <thead>
            <tr>
                <th style="width: 25px;">No</th>
                <th style="width: 70px;">Jenis</th>
                <th style="width: 130px;">Nomor Surat</th>
                <th>Penerima</th>
                <th>Agenda</th>
                <th style="width: 70px;">Tanggal</th>
                <th style="width: 70px;">Pembuat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($arsip as $key => $item)
            <tr class="stripe">
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $item->jenis_surat }}</td>
                <td class="font-bold" style="color: #dc2626;">{{ $item->nomor_surat }}</td>
                <td>{{ $item->penerima }}</td>
                <td>{{ $item->agenda }}</td>
                <td class="text-center">{{ $item->tanggal_dibuat }}</td>
                <td>{{ $item->pembuat }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 20px;">Data arsip tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer text-right">
        Laporan Arsip Digital IMM Adam Malik - Halaman {PAGE_NUM}
    </div>

    <script type="text/php">
        if ( isset($pdf) ) {
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 8;
            $pdf->page_text(520, 810, "Halaman {PAGE_NUM} dari {PAGE_COUNT}", $font, $size, array(0.5,0.5,0.5));
        }
    </script>

</body>
</html>