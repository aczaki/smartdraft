<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'jenis_surat',
        'keyword',
        'path_file'
    ];
}
