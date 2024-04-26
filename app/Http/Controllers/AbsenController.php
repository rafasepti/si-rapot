<?php

namespace App\Http\Controllers;

use App\Models\GuruMapel;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Carbon\Carbon;
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
    
    public function absenWali(){
        $siswa_kel = Siswa::getJoinKId(session('id_user'))->first();
        $siswa = Siswa::where('id_kelas',$siswa_kel->id_kelas)
            ->orderBy('nama_siswa', 'asc')
            ->get();
        $thn_ajaran = TahunAjaran::where('Aktif', 'Ya')->first();
        $mapel2 = Mapel::where('kategori', '1')->get();
        $kd_nilai = Nilai::getkdNilai();
        $today = Carbon::now()->format('d-m-Y');

            return view('wali_kelas/data_absen_sw',
                [
                    'siswa_kel' => $siswa_kel,
                    'siswa' => $siswa,
                    'thn_ajaran' => $thn_ajaran,
                    'mapel2' => $mapel2,
                    'kd_nilai' => $kd_nilai,
                    'today' => $today
                ]
            );
    }
}
