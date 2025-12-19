<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Template;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        Template::create([
            'jenis_surat' => 'undangan',
            'keyword' => 'undang, rapat, menghadiri',
            'path_file' => 'templates/undangan.docx'
        ]);

        Template::create([
            'jenis_surat' => 'peminjaman',
            'keyword' => 'pinjam, peminjaman, meminjam',
            'path_file' => 'templates/peminjaman.docx'
        ]);

        Template::create([
            'jenis_surat' => 'default',
            'keyword' => '',
            'path_file' => 'templates/default.docx'
        ]);
    }
}
