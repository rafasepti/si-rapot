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
}
