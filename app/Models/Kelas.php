<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kelas extends Model
{
    use HasFactory;

    public static function getJoinGuru(){
        $sql = DB::table('kelas as k')
                ->join('guru as g', 'g.id', '=', 'k.id_walikelas')
                ->select('g.*', 'k.id as id_kelas', 'k.kelas' , 'k.tingkat')
                ->get();
        return $sql;
    }

    public static function getJoinGuruId($id){
        $sql = DB::table('kelas as k')
                ->join('guru as g', 'g.id', '=', 'k.id_walikelas')
                ->select('g.*', 'k.id as id_kelas', 'k.kelas' , 'k.tingkat')
                ->where('k.id', $id)
                ->get();
        return $sql;
    }
}
