<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama',
        'npp', // ubah dari nip → npp kalau kamu ganti migrasinya
        'jabatan',
        'unit_kerja',
        'satuan_kerja',
        'judul',
        'materi',
        'narasumber',
        'jam_pembelajaran',
        'ringkasan',
        'catatan',
        'saran',
        'pdf_path',
    ];

    public $timestamps = true;
}
