<?php

namespace App\Exports;

use App\Models\ArsipSurat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArsipExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Arsip::select(
            'nomor_surat',
            'nama_surat',
            'agenda',
            'tanggal_dibuat',
            'pembuat'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nomor Surat',
            'Nama Surat',
            'Agenda',
            'Tanggal Dibuat',
            'Pembuat'
        ];
    }
}
