<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index(){
        if(session('walikelas')=="Ya"){
            $id_user = session('id_user');
            $siswa_kel = Siswa::getJoinKId($id_user)->first();
            $mapel = Mapel::where('kategori', '1')->get();
            if($siswa_kel == ""){
                $siswa_kel = "";
            }
            return view('wali_kelas/data_absen_mapel',
                compact('siswa_kel', 'mapel')
            );
        }else{
            return view('wali_kelas/data_kls');
        }
    }
}
