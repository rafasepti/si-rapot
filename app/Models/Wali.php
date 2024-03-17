<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wali extends Model
{
    use HasFactory;
    protected $table = "wali";

    public static function getCountWali($id){
        $sql = DB::table('wali')
                ->where('id_siswa', $id)
                ->count();
        return $sql;
    }
}
