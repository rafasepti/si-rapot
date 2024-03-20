<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GuruMapel extends Model
{
    use HasFactory;
    protected $table = "guru_mapel";
    protected $fillable = [
        'id_guru',
        'id_mapel',
    ];

    public static function getJoinMapelId($id){
        $sql = DB::table('guru_mapel as g')
                ->join('mapel as m', 'm.id', '=', 'g.id_mapel')
                ->select('m.*', 'g.*')
                ->where('g.id_guru', $id)
                ->get();
        return $sql;
    }

    public static function getJoinMapelKat(){
        $sql = DB::table('guru_mapel as g')
                ->join('mapel as m', 'm.id', '=', 'g.id_mapel')
                ->select('m.*', DB::raw('MAX(g.id) AS id_gm'))
                ->where('m.kategori', 2)
                ->groupBy('m.id')
                ->get();
        return $sql;
    }

    public static function getJoinMapelGuru(){
        $sql = DB::table('guru_mapel as gm')
                ->join('mapel as m', 'm.id', '=', 'gm.id_mapel')
                ->join('guru as g', 'g.kode_guru', '=', 'gm.id_guru')
                ->select('m.*', 'gm.*', 'g.*')
                ->get();
        return $sql;
    }

    public static function getGroupMapel(){
        $sql = Mapel::select('mapel.id', 'mapel.nama_mapel')
        ->with(['guru' => function ($query) {
            $query->select('guru.nama_guru');
        }])
        ->leftJoin('guru_mapel', 'mapel.id', '=', 'guru_mapel.id_mapel')
        ->leftJoin('guru', 'guru_mapel.id_guru', '=', 'guru.kode_guru')
        ->groupBy('mapel.id', 'mapel.nama_mapel')
        ->selectRaw('GROUP_CONCAT(guru.nama_guru) AS nm_g')
        ->get();
    
        return $sql;
    }
}
