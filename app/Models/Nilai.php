<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Nilai extends Model
{
    use HasFactory;
    protected $table = "nilai";

    public static function getkdNilai(){
        $sql = "SELECT IFNULL(MAX(kode_nilai), 'N00000')
            AS id_nilai FROM nilai";
            $id_nilai = DB::select($sql);

            foreach ($id_nilai as $ids) {
                $n = $ids->id_nilai;
            }
            $noawal = substr($n,5);
            $noakhir = (int)$noawal + 1;
            $noakhir = 'N'.str_pad($noakhir,6,"0",STR_PAD_LEFT);
            return $noakhir;
    }

    public static function getNilai1($id_siswa,$id_kelas){
        $sql = Nilai::where('id_siswa', $id_siswa)
            ->where('id_kelas', $id_kelas)
            ->where('semester', 1)
            ->first();
        return $sql;
    }
}
