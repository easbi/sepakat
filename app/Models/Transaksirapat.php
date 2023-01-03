<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksirapat extends Model
{
    use HasFactory;
    public $table = "transaksi_rapat";
    protected $fillable = [
        'nama_rapat',
        'tgl',
        'waktu',
        'tempat',
        'pimpinan_rapat',
        'notulis',
        'undangan',
        'daftar_hadir',
        'notulen',
        'dokumentasi',
    ];
}
