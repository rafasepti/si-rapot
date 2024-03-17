<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Guru extends Model
{
    use HasFactory;
    protected $table = "guru";

    public static function getJoinMapel(){
        $sql = DB::table('guru as g')
                ->join('mapel as m', 'm.id', '=', 'g.id_mapel')
                ->select('m.*', 'g.id as id_guru', 'g.nuptk' , 'g.nama_guru')
                ->get();
        return $sql;
    }

    public static function getJoinMapelId($id){
        $sql = DB::table('guru as g')
                ->join('mapel as m', 'm.id', '=', 'g.id_mapel')
                ->select('m.*', 'g.id as id_guru', 'g.nuptk' , 'g.nama_guru', 'g.alamat_guru', 'g.no_telp')
                ->where('g.id', $id)
                ->get();
        return $sql;
    }

    public static function getCountKepsek(){
        $sql = DB::table('guru')
                ->where('jabatan', "Kepala Sekolah")
                ->count();
        return $sql;
    }
}
