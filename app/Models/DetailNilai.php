<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetailNilai extends Model
{
    use HasFactory;
    protected $table = "detail_nilai";
    protected $fillable = [
        'id_nilai',
        'id_gm',
        'nilai_rl',
        'nilai_tp',
        'nilai_as',
    ];
}
