<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    //
    protected $fillable = [
        'jenis_surat',
        'nomor_surat',
        'penerima',
        'agenda',
        'tanggal_dibuat',
        'pembuat',
        'file_path'
    ];
}
