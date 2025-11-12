<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'tanggal', 'nama', 'nip', 'jabatan', 'unit_kerja',
        'judul', 'ringkasan', 'catatan', 'saran', 'pdf_path'
    ];

    public $timestamps = true;
}
