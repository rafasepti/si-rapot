<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Guru extends Authenticatable
{
    use HasFactory;
    use HasApiTokens, Notifiable;
    protected $table = "guru";

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        //'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_walikelas');
    }

    public static function getJoinMapel(){
        $sql = DB::table('guru as g')
                ->join('mapel as m', 'm.id', '=', 'g.id_mapel')
                ->select('m.*', 'g.id as id_guru', 'g.*')
                ->get();
        return $sql;
    }

    public static function getJoinMapelId($id){
        $sql = DB::table('guru as g')
                ->join('mapel as m', 'm.id', '=', 'g.id_mapel')
                ->select('m.*', 'g.id as id_guru', 'g.*')
                ->where('g.kode_guru', $id)
                ->get();
        return $sql;
    }

    public static function getCountKepsek(){
        $sql = DB::table('guru')
                ->where('jabatan', "Kepala Sekolah")
                ->count();
        return $sql;
    }

    public static function getJabatan($id){
        $sql = DB::table('guru')
                ->where('id', $id)
                ->get();
        return $sql;
    }

    public static function getIdGuru(){
        $sql = "SELECT IFNULL(MAX(kode_guru), 'G00000')
            AS id_guru FROM guru";
            $id_guru = DB::select($sql);

            foreach ($id_guru as $ids) {
                $gr = $ids->id_guru;
            }
            $noawal = substr($gr,5);
            $noakhir = (int)$noawal + 1;
            $noakhir = 'G'.str_pad($noakhir,6,"0",STR_PAD_LEFT);
            return $noakhir;
    }
}
