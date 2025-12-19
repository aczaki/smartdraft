<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    //
    protected $fillable = [
        'nama_surat',
        'nomor_surat',
        'agenda',
        'tanggal_dibuat',
        'pembuat',
        'file_path'
    ];
}
