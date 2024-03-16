<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswa";

    public static function getJoinKelas(){
        $sql = DB::table('siswa as s')
                ->join('kelas as k', 'k.id', '=', 's.id_kelas')
                ->select([
                    's.id as id_siswa',
                    's.*',
                    DB::raw("CONCAT(k.tingkat, ' - ', k.kelas) as kel"),
                ])
                ->get();
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
        $sql = DB::table('guru as g')
                ->join('mapel as m', 'm.id', '=', 'g.id_mapel')
                ->select('m.*', 'g.id as id_guru', 'g.nuptk' , 'g.nama_guru', 'g.alamat_guru', 'g.no_telp')
                ->where('g.id', $id)
                ->get();
        return $sql;
    }
}
