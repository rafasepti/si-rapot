<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $table = "absen";
    protected $fillable = [
        'tanggal',
        'id_siswa',
        'id_kelas',
        'id_mapel',
        'semester',
        'k_hadir',
        'k_sakit',
        'k_izin',
        'k_alpha',
    ];
}
