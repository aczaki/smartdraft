<?php

namespace App\Services;

class ExtractionService
{
    // =============================
    // NOMOR SURAT
    // =============================
    public function extractNomor(string $text): ?string
    {
        // Contoh pola: 19/A-9/XI/2023 atau 021/UND/IMM/2024
        $pattern = '/\b(\d{1,3}\/[A-Za-z0-9\-]+\/[A-Za-z0-9\-]+\/\d{4})\b/';

        if (preg_match($pattern, $text, $match)) {
            return trim($match[1]);
        }
        return null;
    }

    // =============================
    // PENERIMA
    // =============================
    public function extractPenerima(string $text): ?string
    {
        $pattern = '/kepada\s+(.+?)(?=\s+(untuk|dengan)\b)/iu';

        if (preg_match($pattern, $text, $match)) {
            return trim($match[1]);
        }

        return null;
    }





    // =============================
    // AGENDA
    // =============================
    public function extractAgenda(string $text): ?string
    {
        // Pola umum: agenda: Pelantikan, acara ... dst.
        $patterns = [
            '/agenda[:\-]\s*([^,\.]+)/i',
            '/acara[:\-]\s*([^,\.]+)/i',
            '/untuk\s+keperluan\s+([^,\.]+)/i'
        ];


        foreach ($patterns as $p) {
            if (preg_match($p, $text, $match)) {
                return trim($match[1]);
            }
        }

        return null;
    }

    // =============================
    // TANGGAL
    // =============================
    public function extractTanggal(string $text): ?string
    {
        $pattern = '~pada\s+([A-Za-z\-]+,\s+\d{1,2}(?:-\d{1,2})?\s+(?:Januari|Februari|Maret|April|Mei|Juni|Juli|Agustus|September|Oktober|November|Desember)\s+\d{4})~iu';

        if (preg_match($pattern, $text, $match)) {
            return trim($match[1]);
        }

        return null;
    }



    // =============================
    // WAKTU
    // =============================
    public function extractWaktu(string $text): ?string
    {
        $pattern = '~
            (\d{1,2}[:\.]\d{2})          # waktu awal
            \s*
            (?:-|–|s\/d|sd|sampai)?      # pemisah
            \s*
            (selesai|\d{1,2}[:\.]\d{2})? # waktu akhir / selesai
            \s*
            (WIB)?                       # zona waktu
        ~ix';

        if (preg_match($pattern, $text, $match)) {
            return trim($match[0]);
        }

        return null;
    }





    // =============================
    // TEMPAT
    // =============================
    public function extractTempat(string $text): ?string
    {
        // pola: Tempat: Gedung Seminar, di Aula, di Gedung Jseminar 2
        $patterns = [
            '/tempat[:\-]\s*([^\.]+)/i',   // ambil sampai sebelum titik
            '/di\s+([^\.]+)/i',           // ambil sampai sebelum titik
        ];


        foreach ($patterns as $p) {
            if (preg_match($p, $text, $match)) {
                return trim($match[1]);
            }
        }

        return null;
    }

   public function extractBidang(string $text): ?string
    {
        $pattern = '/oleh\s+(.+?)(?=\.|\n|$)/iu';

        if (preg_match($pattern, $text, $match)) {
            return strtoupper(trim($match[1]));
        }

        return null;
    }





    //ekstrak ketua
    public function extractKetua($text)
    {
        $pattern = '/ketua[:\-]?\s*([A-Za-z\s]+)(?=,|\.|\n|$)/i';

        if (preg_match($pattern, $text, $match)) {
            return trim($match[1]);
        }
        return null;
    }

    //eksrak sekretaris
    public function extractSekretaris($text)
    {
        $pattern = '/sekretaris[:\-]?\s*([A-Za-z\s]+)(?=,|\.|\n|$)/i';

        if (preg_match($pattern, $text, $match)) {
            return trim($match[1]);
        }
        return null;
    }

    //ekstrak penanggungjawab
    public function extractPenanggungJawab($text)
    {
        $pattern = '/(penanggung\s*jawa[bp]|pj)[:\-]?\s*([A-Za-z\s]+)(?=,|\.|\n|$)/i';

        if (preg_match($pattern, $text, $match)) {
            return trim($match[2]);
        }
        return null;
    }

    // =============================
    // JENIS SURAT
    // =============================
    public function detectJenisSurat(string $text): string
    {
        $mapping = [
            'undangan'              => 'undangan',
            'keterangan aktif'      => 'keterangan aktif',
            'permohonan pembicara'  => 'permohonan pembicara',
            'permohonan'            => 'permohonan',
            'peminjaman alat'       => 'peminjaman alat',
            'pemberitahuan'         => 'pemberitahuan',
            'peminjaman tempat'     => 'peminjamantempat'
        ];

        foreach ($mapping as $key => $jenis) {
            if (stripos($text, $key) !== false) {
                return $jenis;
            }
        }

        return 'umum';
    }

    public function extractTglHijriah(string $text): ?string
    {
        $pattern = '/bertepatan(?:\s+dengan)?\s*[:\-]?\s*' .
                '((?:\d{1,2}\s+)?' .        // angka hari OPSIONAL
                '[A-Za-z\p{L}]+' .           // nama bulan hijriah
                '(?:\s+[A-Za-z\p{L}]+)?' .   // antisipasi "Jumadil Akhir"
                '\s+\d{3,4}\s*H)' .           // tahun hijriah
                '(?=\s|,|\.|$)/iu';

        if (preg_match($pattern, $text, $match)) {
            return trim($match[1]);
        }

        return null;
    }




    public function generateTglDibuat(): string
    {
        // Array bulan Indonesia
        $bulanIndo = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $hari = date('d');                           // 08
        $bulan = $bulanIndo[(int)date('m')];         // Desember
        $tahun = date('Y');                          // 2025

        return $hari . ' ' . $bulan . ' ' . $tahun . ' M';
    }

    public function extractJabatan(string $text): ?string
    {
        $pattern = '/
            (Sebagai\s+.+?)          # mulai dari kata "Sebagai"
            \s+
            Periode\s+\d{4}\/\d{4}   # batas akhir tahun 2024\/2025
        /ix';

        if (preg_match($pattern, $text, $match)) {
            return trim($match[0]);
        }

        return null;
    }

    public function extractAlat(string $text): ?string
    {
        $pattern = '/meminjam\s+([^\.]+)\./i';

        if (preg_match($pattern, $text, $match)) {
            return trim($match[1]);
        }

        return null;
    }




}
