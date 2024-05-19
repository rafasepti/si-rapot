<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\GuruKelas;
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
            $kelas = GuruKelas::getKelasDiajar(session('id_user'));
            return view('wali_kelas/data_absen_mapel',
                compact('kelas')
            );
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

    public function absenGuru($id){
        $siswa_kel = Kelas::findOrFail($id);
        $siswa = Siswa::where('id_kelas',$id)
            ->orderBy('nama_siswa', 'asc')
            ->get();
        $thn_ajaran = TahunAjaran::where('Aktif', 'Ya')->first();
        $mapel2 = GuruMapel::getJoinMapelId(session('kode_guru'));
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

    public function store(Request $request){
        // Validasi request
    $request->validate([
        'id_siswa' => 'required|array',
        //'k_absen'. $request->id_siswa => 'required|array',
        // Tambahkan validasi sesuai kebutuhan Anda untuk field lainnya
    ]);

    // Loop untuk menyimpan data absen dari setiap siswa
    foreach ($request->id_siswa as $index => $id_siswa) {
        $absenHariIni = Absen::where('id_mapel', $request->id_mapel)
                            ->where('id_siswa', $id_siswa)
                             ->whereDate('tanggal', Carbon::today())
                             ->first();

        // Jika entri absen sudah ada, berikan pesan kesalahan
        if ($absenHariIni) {
            return redirect()->back()->with('error', 'Absen untuk siswa ini sudah dilakukan hari ini.');
        }

        $absen = new Absen();
        $absen->id_siswa = $id_siswa;
        $absen->id_thn_ajaran = $request->id_thn_ajaran;
        $absen->id_mapel = $request->id_mapel;
        $absen->tanggal = Carbon::now()->format('Y-m-d');
        $absen->id_kelas = $request->id_kelas;
        $absen->semester = $request->semester;
        $absen->k_hadir = ($request->input('k_absen_' . $id_siswa) == 'hadir') ? 1 : 0;
        $absen->k_sakit = ($request->input('k_absen_' . $id_siswa) == 'sakit') ? 1 : 0;
        $absen->k_izin = ($request->input('k_absen_' . $id_siswa) == 'izin') ? 1 : 0;
        $absen->k_alpha = ($request->input('k_absen_' . $id_siswa) == 'alpha') ? 1 : 0;
        // Tambahkan logika lain jika diperlukan
        $absen->save();
    }

    // Redirect ke halaman atau tindakan selanjutnya
    return redirect()->back()->with('success', 'Data absen berhasil disimpan.');
    }
}
