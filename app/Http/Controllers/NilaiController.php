<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Http\Requests\StoreNilaiRequest;
use App\Http\Requests\UpdateNilaiRequest;
use App\Models\DetailNilai;
use App\Models\Guru;
use App\Models\GuruKelas;
use App\Models\GuruMapel;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        if(session('walikelas')=="Ya"){
            $kelas= Kelas::all();
            $siswa = DB::table('siswa as s')
            ->join('kelas as k', 'k.id', '=', 's.id_kelas')
            ->select([
                's.id as id_siswa',
                's.*',
                'k.id as id_k',
                DB::raw("CONCAT(k.tingkat, ' - ', k.kelas) as kel"),
            ])
            ->where('s.id', $id)
            ->first();
            $thn_ajaran = TahunAjaran::where('Aktif', 'Ya')->first();
            $mapel = Mapel::where('kategori', '1')->get();
            $mapel2 = Mapel::where('kategori', '2')->get();
            $kd_nilai = Nilai::getkdNilai();

            $nilai_siswa = Nilai::where('id_siswa', $id)
                ->where('id_kelas', $siswa->id_k)
                ->first();

            return view('wali_kelas/tambah_nilai',
                [
                    'kelas' => $kelas,
                    'siswa' => $siswa,
                    'thn_ajaran' => $thn_ajaran,
                    'mapel' => $mapel,
                    'mapel2' => $mapel2,
                    'kd_nilai' => $kd_nilai,
                ]
            );
        }else{
            $kelas= Kelas::where('id', $id)->first();
            $siswa = Siswa::where('id_kelas',$id)
                ->orderBy('nama_siswa', 'asc')
                ->get();
            $thn_ajaran = TahunAjaran::where('Aktif', 'Ya')->first();
            $mapel2 = GuruMapel::getJoinMapelId(session('kode_guru'));
            $kd_nilai = Nilai::getkdNilai();

            return view('wali_kelas/tambah_nilai_sw',
                [
                    'kelas' => $kelas,
                    'siswa' => $siswa,
                    'thn_ajaran' => $thn_ajaran,
                    'mapel2' => $mapel2,
                    'kd_nilai' => $kd_nilai,
                ]
            );
        }
    }

    public function update($id)
    {
        if(session('walikelas')=="Ya"){
            $kelas= Kelas::all();
            $siswa = DB::table('siswa as s')
            ->join('kelas as k', 'k.id', '=', 's.id_kelas')
            ->select([
                's.id as id_siswa',
                's.*',
                'k.id as id_k',
                DB::raw("CONCAT(k.tingkat, ' - ', k.kelas) as kel"),
            ])
            ->where('s.id', $id)
            ->first();
            $thn_ajaran = TahunAjaran::where('Aktif', 'Ya')->first();
            $mapel = Mapel::where('kategori', '1')->get();
            $mapel2 = Mapel::where('kategori', '2')->get();
            $kd_nilai = Nilai::getkdNilai();

            $nilai_siswa = Nilai::where('id_siswa', $id)
                ->where('id_kelas', $siswa->id_k)
                ->first();

            return view('wali_kelas/edit_nilai',
                [
                    'kelas' => $kelas,
                    'siswa' => $siswa,
                    'thn_ajaran' => $thn_ajaran,
                    'mapel' => $mapel,
                    'mapel2' => $mapel2,
                    'kd_nilai' => $kd_nilai,
                ]
            );
        }else{
            $kelas= Kelas::where('id', $id)->first();
            $siswa = Siswa::where('id_kelas',$id)
                ->orderBy('nama_siswa', 'asc')
                ->get();
            $thn_ajaran = TahunAjaran::where('Aktif', 'Ya')->first();
            $mapel2 = GuruMapel::getJoinMapelId(session('kode_guru'));
            $kd_nilai = Nilai::getkdNilai();

            return view('wali_kelas/tambah_nilai_sw',
                [
                    'kelas' => $kelas,
                    'siswa' => $siswa,
                    'thn_ajaran' => $thn_ajaran,
                    'mapel2' => $mapel2,
                    'kd_nilai' => $kd_nilai,
                ]
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNilaiRequest $request)
    {
        if(session('walikelas')=="Ya"){
                $validatedData = $request->validated();
                foreach ($request->id_mapel as $key => $id_mapel) {
                    // Jika data ditemukan, simpan ID guru_mapel ke dalam tabel guru_kelas
                    $nilai_akhir = ($request->nilai_rl[$key] + ($request->nilai_tp[$key]*2) + ($request->nilai_as[$key]*2))/5;
                    $guruKelas = new DetailNilai();
                    $guruKelas->id_nilai = $request->id_nilai;
                    $guruKelas->id_mapel = $id_mapel; 
                    $guruKelas->nilai_rl = $request->nilai_rl[$key]; 
                    $guruKelas->nilai_tp = $request->nilai_tp[$key]; 
                    $guruKelas->nilai_as = $request->nilai_as[$key];
                    $guruKelas->nilai_akhir = $nilai_akhir;
                    $guruKelas->ket = $request->ket[$key]; 
                    $guruKelas->save();
                }
                
                DB::table('nilai')->insert([
                    'id_siswa' => $request->id_siswa,
                    'id_kelas' => $request->id_kelas,
                    'kode_nilai' => $request->id_nilai,
                    'id_thn_ajaran' => $request->id_thn_ajaran,
                    'semester' => $request->semester,
                    'kehadiran_izin' => $request->kehadiran_izin,
                    'kehadiran_sakit' => $request->kehadiran_sakit,
                    'kehadiran_tanpa_ket' => $request->kehadiran_tanpa_ket,
                    'tgl_penilaian' => date('y-m-d'),
                    'catatan' => $request->catatan,
                ]);
            
        }else{
            foreach ($request->id_siswa as $key => $id_siswa) {
                $nilai_siswa = Nilai::where('id_siswa', $id_siswa)
                ->where('semester',$request->semester)
                ->where('id_kelas', $request->id_kelas)
                ->first();

                $nilai_akhir = ($request->nilai_rl[$key] + ($request->nilai_tp[$key]*2) + ($request->nilai_as[$key]*2))/5;
                if($nilai_siswa){
                    $guruKelas = new DetailNilai();
                    $guruKelas->id_nilai = $nilai_siswa->kode_nilai;
                    $guruKelas->id_mapel = $request->id_mapel; 
                    $guruKelas->nilai_rl = $request->nilai_rl[$key]; 
                    $guruKelas->nilai_tp = $request->nilai_tp[$key]; 
                    $guruKelas->nilai_as = $request->nilai_as[$key]; 
                    $guruKelas->nilai_akhir = $nilai_akhir;
                    $guruKelas->ket = $request->ket[$key]; 
                    $guruKelas->save();
                }else{
                    $guruKelas = new DetailNilai();
                    $guruKelas->id_nilai = Nilai::getkdNilai();
                    $guruKelas->id_mapel = $request->id_mapel; 
                    $guruKelas->nilai_rl = $request->nilai_rl[$key]; 
                    $guruKelas->nilai_tp = $request->nilai_tp[$key]; 
                    $guruKelas->nilai_as = $request->nilai_as[$key];
                    $guruKelas->nilai_akhir = $nilai_akhir; 
                    $guruKelas->ket = $request->ket[$key]; 
                    $guruKelas->save();
    
                    DB::table('nilai')->insert([
                        'id_siswa' => $request->id_siswa[$key],
                        'id_kelas' => $request->id_kelas,
                        'kode_nilai' => Nilai::getkdNilai(),
                        'id_thn_ajaran' => $request->id_thn_ajaran,
                        'semester' => $request->semester,
                        'tgl_penilaian' => date('y-m-d'),
                    ]);
                }
            }
        }
        return redirect('/kelaswali');
    }

    public function storeSiswa(StoreNilaiRequest $request)
    {
        

        return redirect('/kelaswali');
    }

    public function generatePDF1($id)
    {
        $siswa = DB::table('siswa as s')
        ->join('kelas as k', 'k.id', '=', 's.id_kelas')
        ->select([
            's.id as id_siswa',
            's.*',
            'k.id as id_k',
            DB::raw("CONCAT(k.tingkat, ' - ', k.kelas) as kel"),
        ])
        ->where('s.id', $id)
        ->first();
        $mapel = Mapel::where('kategori', '1')->get();
        $mapelb = Mapel::where('kategori', '2')->get();
        $thn_ajaran = TahunAjaran::where('Aktif', 'Ya')->first();
        $nilai1 = Nilai::getNilai1($siswa->id_siswa,$siswa->id_kelas);
        if ($nilai1 !== null) {
            $detail_nilai1 = DetailNilai::where('id_nilai', $nilai1->kode_nilai)->get();
        } else {
            $detail_nilai1 = collect();
        }

        // Render view PDF dan data
        return view('pdf/nilai', compact(
            'siswa', 
            'mapel', 
            'mapelb', 
            'nilai1', 
            'detail_nilai1',
            'thn_ajaran'
        ));
    }

    public function generatePDF2($id)
    {
        $siswa = DB::table('siswa as s')
        ->join('kelas as k', 'k.id', '=', 's.id_kelas')
        ->select([
            's.id as id_siswa',
            's.*',
            'k.id as id_k',
            DB::raw("CONCAT(k.tingkat, ' - ', k.kelas) as kel"),
        ])
        ->where('s.id', $id)
        ->first();
        $kepsek = Guru::where('jabatan', 'Kepala Sekolah')->first();
        $mapel = Mapel::where('kategori', '1')->get();
        $mapelb = Mapel::where('kategori', '2')->get();
        $thn_ajaran = TahunAjaran::where('Aktif', 'Ya')->first();
        $nilai1 = Nilai::getNilai2($siswa->id_siswa,$siswa->id_kelas);
        if ($nilai1 !== null) {
            $detail_nilai1 = DetailNilai::where('id_nilai', $nilai1->kode_nilai)->get();
        } else {
            $detail_nilai1 = collect();
        }

        // Render view PDF dan data
        return view('pdf/nilai2', compact(
            'siswa', 
            'kepsek', 
            'mapel', 
            'mapelb', 
            'nilai1', 
            'detail_nilai1',
            'thn_ajaran'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $thn_ajaran = TahunAjaran::where('Aktif', 'Ya')->first();
        
        if(session('walikelas')=="Ya"){
            $siswa = DB::table('siswa as s')
            ->join('kelas as k', 'k.id', '=', 's.id_kelas')
            ->select([
                's.id as id_siswa',
                's.*',
                'k.id as id_k',
                DB::raw("CONCAT(k.tingkat, ' - ', k.kelas) as kel"),
            ])
            ->where('s.id', $id)
            ->first();
            $mapel = Mapel::where('kategori', '1')->get();
            $mapelb = Mapel::where('kategori', '2')->get();
            $nilai1 = Nilai::getNilai1($siswa->id_siswa,$siswa->id_kelas);
            $nilai2 = Nilai::getNilai2($siswa->id_siswa,$siswa->id_kelas);

            if ($nilai1 !== null) {
                $detail_nilai1 = DetailNilai::where('id_nilai', $nilai1->kode_nilai)->get();
            } else {
                $detail_nilai1 = collect();
            }

            if ($nilai2 !== null) {
                $detail_nilai2 = DetailNilai::where('id_nilai', $nilai2->kode_nilai)->get();
            } else {
                $detail_nilai2 = collect();
            }
            
            return view('wali_kelas/detail_nilai',
                [
                    'siswa' => $siswa,
                    'thn_ajaran' => $thn_ajaran,
                    'mapel' => $mapel,
                    'mapelb' => $mapelb,
                    'nilai1' => $nilai1,
                    'detail_nilai1' => $detail_nilai1,
                    'nilai2' => $nilai2,
                    'detail_nilai2' => $detail_nilai2,
                ]
            );
        }else{
            
        }
    }

    public function show_sw(Request $request, $id){
        $thn_ajaran = TahunAjaran::where('Aktif', 'Ya')->first();
        $kelas= Kelas::where('id', $id)->first();
        $siswa = Siswa::where('id_kelas',$id)
            ->orderBy('nama_siswa', 'asc')
            ->get();
        $mapel2 = GuruMapel::getJoinMapelId(session('kode_guru'));

        $nilai1 = Nilai::getJoinDetail()
            ->where('nilai.id_kelas',$id)
            ->where('nilai.semester', 1)
            ->get();
        $nilai2 = Nilai::getJoinDetail()
            ->where('nilai.id_kelas',$id)
            ->where('nilai.semester', 2)
            ->distinct()
            ->get();

         if ($nilai1 === null) {
            $nilai1 = collect();
        }

        if ($nilai2 === null) {
            $nilai2 = collect();
        }
        return view('wali_kelas/detail_sw',
            [
                'kelas' => $kelas,
                'siswa' => $siswa,
                'thn_ajaran' => $thn_ajaran,
                'mapel2' => $mapel2,
                'nilai1' => $nilai1,
                'nilai2' => $nilai2,
            ]);
    } 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nilai $nilai)
    {
        //
    }
}
