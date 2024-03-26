<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Guru;
use App\Models\GuruKelas;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $id_user = session('id_user');
        if(session('walikelas')== "Ya"){
            $siswa_kel = Siswa::getJoinKId($id_user)->first();
            if($siswa_kel == null){
                $siswa_kel = Kelas::where('id_walikelas', $id_user)->first();
                $countSiswa = 0;
            }else{
                $countSiswa = Siswa::where('id_kelas', $siswa_kel->id_kelas)->count();
            }
        }
        $countGuru = Guru::where('jabatan', "Guru")->count();
        $countKelas = Kelas::count();
        $kepsek = Guru::where('jabatan', 'Kepala Sekolah')->first();
        $kelas_ajar = GuruKelas::getKelasDiajar($id_user);

        $ekskul = Ekskul::where('id_guru', auth()->id())->first();
        
        if(session('walikelas')== "Ya"){
            return view('admin/v_admin',
            [
                'siswa_kel' => $siswa_kel,
                'countSiswa' => $countSiswa,
                'countGuru' => $countGuru,
                'countKelas' => $countKelas,
                'kepsek' => $kepsek,
                'ekskul' => $ekskul,
                'kelas_ajar' => $kelas_ajar,
            ]);
        }else{
            return view('admin/v_admin',
            [
                'countGuru' => $countGuru,
                'countKelas' => $countKelas,
                'kepsek' => $kepsek,
                'ekskul' => $ekskul,
                'kelas_ajar' => $kelas_ajar,
            ]);
        }
        
    }
}
