<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GuruKelas extends Model
{
    use HasFactory;

    public static function getJoinId($id){
        $sql = GuruKelas::join('guru_mapel', 'guru_kelas.id_gm', '=', 'guru_mapel.id')
            ->join('guru', 'guru_mapel.id_guru', '=', 'guru.kode_guru')
            ->join('mapel', 'guru_mapel.id_mapel', '=', 'mapel.id')
            ->where('guru_kelas.id_kelas', $id)
            ->select('guru.nama_guru', 'mapel.nama_mapel', 'guru.kode_guru', 'guru_kelas.id')
            ->get();
        return $sql;
    }

    public static function getKelasDiajar($id){
        $sql = GuruKelas::join('kelas', 'guru_kelas.id_kelas', '=', 'kelas.id')
        ->join('guru_mapel', 'guru_kelas.id_gm', '=', 'guru_mapel.id')
        ->join('guru', 'guru_mapel.id_guru', '=', 'guru.kode_guru')
        ->join('mapel', 'guru_mapel.id_mapel', '=', 'mapel.id')
        ->where('guru.id', $id)
        ->select('guru.nama_guru', 'mapel.nama_mapel', 'guru.kode_guru', 'guru_kelas.id', 'kelas.id as ids_kelas','kelas.tingkat', 'kelas.kelas')
        ->get();
        return $sql;
    }
}
