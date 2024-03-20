<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswa";

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public static function getJoinKelas(){
        $sql = DB::table('siswa as s')
                ->join('kelas as k', 'k.id', '=', 's.id_kelas')
                ->select([
                    's.id as id_siswa',
                    's.*',
                    DB::raw("CONCAT(k.tingkat, ' - ', k.kelas) as kel"),
                ]);
        return $sql;
    }

    public static function getJoinKId($id_user){
        $sql = DB::table('siswa as s')
                ->join('kelas as k', 'k.id', '=', 's.id_kelas')
                ->select([
                    's.id as id_siswa',
                    's.*',
                    'k.*',
                    'k.id as id_kelas'
                ])
                ->where('k.id_walikelas', $id_user);
        return $sql;
    }

    public static function getIdSiswa(){
        $sql = "SELECT IFNULL(MAX(kode_siswa), 'S00000')
            AS id_siswa FROM siswa";
            $id_siswa = DB::select($sql);

            foreach ($id_siswa as $ids) {
                $sis = $ids->id_siswa;
            }
            $noawal = substr($sis,5);
            $noakhir = (int)$noawal + 1;
            $noakhir = 'S'.str_pad($noakhir,6,"0",STR_PAD_LEFT);
            return $noakhir;
    }

    public static function getJoinKelasId($id){
        $sql = DB::table('siswa as s')
                ->join('kelas as k', 'k.id', '=', 's.id_kelas')
                ->select([
                    's.id as id_siswa',
                    's.*',
                    DB::raw("CONCAT(k.tingkat, ' - ', k.kelas) as kel"),
                ])
                ->where('s.kode_siswa', $id)
                ->get();
        return $sql;
    }
}
