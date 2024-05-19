<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Http\Requests\StoreNilaiRequest;
use App\Http\Requests\UpdateNilaiRequest;
use App\Models\Absen;
use App\Models\DetailNilai;
use App\Models\Ekskul;
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

    public function createEks($id){
            $ekskul = Ekskul::where('id_guru', auth()->id())->first();
            $siswa = Siswa::where('id_ekskul',$ekskul->id)
                ->orderBy('nama_siswa', 'asc')
                ->get();
            $thn_ajaran = TahunAjaran::where('Aktif', 'Ya')->first();
            $mapel2 = GuruMapel::getJoinMapelId(session('kode_guru'));
            $kd_nilai = Nilai::getkdNilai();

            return view('wali_kelas/tambah_nilai_sw',
            [
                'ekskul' => $ekskul,
                'siswa' => $siswa,
                'thn_ajaran' => $thn_ajaran,
                'mapel2' => $mapel2,
                'kd_nilai' => $kd_nilai,
            ]);
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
            $nilai_siswa = Nilai::where('id_siswa', $request->id_siswa)
                    ->where('semester',$request->semester)
                    ->where('id_kelas', $request->id_kelas)
                    ->first();
            $id_nilai = $nilai_siswa ? $nilai_siswa->kode_nilai : $request->id_nilai;
            
            foreach ($request->id_mapel as $key => $id_mapel) {
                $guruKelas = DetailNilai::where('id_nilai', $id_nilai)
                    ->where('id_mapel', $id_mapel)
                    ->first();
                $nilai_akhir = ($request->nilai_rl[$key] + ($request->nilai_tp[$key]*2) + ($request->nilai_as[$key]*2))/5;
                
                if ($guruKelas) { 
                    $guruKelas->nilai_rl = $request->nilai_rl[$key]; 
                    $guruKelas->nilai_tp = $request->nilai_tp[$key]; 
                    $guruKelas->nilai_as = $request->nilai_as[$key];
                    $guruKelas->nilai_akhir = $nilai_akhir;
                    $guruKelas->ket = $request->ket[$key]; 
                    $guruKelas->save();
                }else{
                    $guruKelas = new DetailNilai();  
                    $guruKelas->id_nilai = $id_nilai;      
                    $guruKelas->id_mapel = $id_mapel; 
                    $guruKelas->nilai_rl = $request->nilai_rl[$key]; 
                    $guruKelas->nilai_tp = $request->nilai_tp[$key]; 
                    $guruKelas->nilai_as = $request->nilai_as[$key];
                    $guruKelas->nilai_akhir = $nilai_akhir;
                    $guruKelas->ket = $request->ket[$key]; 
                    $guruKelas->save();
                }
            }
                
            if($nilai_siswa){
                    DB::table('nilai')->where('kode_nilai', $nilai_siswa->kode_nilai)
                        ->update([
                        'kehadiran_izin' => $request->kehadiran_izin,
                        'kehadiran_sakit' => $request->kehadiran_sakit,
                        'kehadiran_tanpa_ket' => $request->kehadiran_tanpa_ket,
                        'tgl_penilaian' => date('y-m-d'),
                        'catatan' => $request->catatan,
                    ]);
            }else{
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
            }
        }else{
            foreach ($request->id_siswa as $key => $id_siswa) {
                $nilai_siswa = Nilai::where('id_siswa', $id_siswa)
                ->where('semester',$request->semester)
                ->where('id_kelas', $request->id_kelas)
                ->first();
                
                $nilai_akhir = ($request->nilai_rl[$key] + ($request->nilai_tp[$key]*2) + ($request->nilai_as[$key]*2))/5;
                
                if($nilai_siswa){
                    $kd_nilai = $nilai_siswa->kode_nilai;
                    $guruKelas = DetailNilai::where('id_nilai', $kd_nilai)
                        ->where('id_mapel', $request->id_mapel)
                        ->first();

                        if ($guruKelas) {
                            // Update nilai jika detail nilai ditemukan
                            $guruKelas->nilai_rl = $request->nilai_rl[$key]; 
                            $guruKelas->nilai_tp = $request->nilai_tp[$key]; 
                            $guruKelas->nilai_as = $request->nilai_as[$key]; 
                            $guruKelas->nilai_akhir = $nilai_akhir;
                            $guruKelas->ket = $request->ket[$key]; 
                            // $guruKelas->k_izin = $request->k_izin[$key]; 
                            // $guruKelas->k_sakit = $request->k_sakit[$key]; 
                            // $guruKelas->k_tanpa_ket = $request->k_tanpa_ket[$key]; 
                            $guruKelas->save();
                        } else {
                            // Buat detail nilai baru jika tidak ditemukan
                            $guruKelas = new DetailNilai();
                            $guruKelas->id_nilai = $kd_nilai;
                            $guruKelas->id_mapel = $request->id_mapel; 
                            $guruKelas->nilai_rl = $request->nilai_rl[$key]; 
                            $guruKelas->nilai_tp = $request->nilai_tp[$key]; 
                            $guruKelas->nilai_as = $request->nilai_as[$key]; 
                            $guruKelas->nilai_akhir = $nilai_akhir;
                            $guruKelas->ket = $request->ket[$key]; 
                            // $guruKelas->k_izin = $request->k_izin[$key]; 
                            // $guruKelas->k_sakit = $request->k_sakit[$key]; 
                            // $guruKelas->k_tanpa_ket = $request->k_tanpa_ket[$key]; 
                            $guruKelas->save();
                        }
                }else{
                    $guruKelas = new DetailNilai();
                    $guruKelas->id_nilai = Nilai::getkdNilai();
                    $guruKelas->id_mapel = $request->id_mapel; 
                    $guruKelas->nilai_rl = $request->nilai_rl[$key]; 
                    $guruKelas->nilai_tp = $request->nilai_tp[$key]; 
                    $guruKelas->nilai_as = $request->nilai_as[$key]; 
                    $guruKelas->nilai_akhir = $nilai_akhir;
                    $guruKelas->ket = $request->ket[$key]; 
                    // $guruKelas->k_izin = $request->k_izin[$key]; 
                    // $guruKelas->k_sakit = $request->k_sakit[$key]; 
                    // $guruKelas->k_tanpa_ket = $request->k_tanpa_ket[$key]; 
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

    public function storeEks(StoreNilaiRequest $request)
    {
        foreach ($request->id_siswa as $key => $id_siswa) {
            $nilai_siswa = Nilai::where('id_siswa', $id_siswa)
            ->where('semester',$request->semester)
            ->where('id_kelas', $request->id_kelas[$key])
            ->first();
            if($nilai_siswa){
                DB::table('nilai')->where('kode_nilai', $nilai_siswa->kode_nilai)
                    ->update([
                    'nilai_eks' => $request->nilai_eks[$key],
                    'id_ekskul' => $request->id_ekskul,
                    'ket_eks' => $request->ket_eks[$key],
                ]);
            }else{
                DB::table('nilai')->insert([
                    'id_siswa' => $request->id_siswa[$key],
                    'id_kelas' => $request->id_kelas[$key],
                    'kode_nilai' => Nilai::getkdNilai(),
                    'id_thn_ajaran' => $request->id_thn_ajaran,
                    'semester' => $request->semester,
                    'nilai_eks' => $request->nilai_eks[$key],
                    'id_ekskul' => $request->id_ekskul,
                    'ket_eks' => $request->ket_eks[$key],
                    'tgl_penilaian' => date('y-m-d'),
                ]);
            }
        }
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function filter(Request $request)
    {
        // Ambil nilai dari database berdasarkan semester yang diberikan
        $ekskul = Ekskul::where('id_guru', auth()->id())->first();
        $nilai = Nilai::where('semester', $request->semester)
            ->where('id_ekskul', $ekskul->id)
            ->get();

        // Jika data tersedia, kirimkan data nilai ke browser
        return response()->json($nilai, 200);
    }

    public function filter_sw(Request $request)
    {
        $mapelG = GuruMapel::where('id_guru',session('kode_guru'))->first();
        $nilai = Nilai::getJoinDetail()
            ->where('nilai.semester', $request->semester)
            ->where('dn.id_mapel', $mapelG->id_mapel)
            ->get();

        // Jika data tersedia, kirimkan data nilai ke browser
        return response()->json($nilai, 200);
    }

    public function filter_n(Request $request)
    {
        $nilai_detail = Nilai::getJoinDetail()
            ->where('nilai.semester', $request->semester)
            ->where('nilai.id_siswa', $request->id_siswa)
            ->where('nilai.id_kelas', $request->id_kelas)
            ->get();
        $nilai = Nilai::where('semester',$request->semester )
            ->where('id_siswa', $request->id_siswa)
            ->where('id_kelas', $request->id_kelas)
            ->first();

        // Menyatukan data dalam satu array asosiatif
        $response = [
            'nilai' => $nilai,
            'nilai_detail' => $nilai_detail
        ];

        // Mengirim respons JSON dengan data yang disatukan
        return response()->json($response, 200);
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
            $ekskul = Ekskul::where('id', $nilai1->id_ekskul)->first();
            $detail_nilai1 = DetailNilai::where('id_nilai', $nilai1->kode_nilai)->get();
            $absensi = Absen::where('id_siswa', $id)
                ->where('semester', 1)
                ->get();

            // Lakukan pengelompokan berdasarkan ID siswa
            $absensi_per_siswa = $absensi->groupBy('id_siswa');

            // Inisialisasi array untuk menyimpan total absen per siswa
            $total_absen_per_siswa = [];

            // Hitung total absen untuk setiap siswa
            foreach ($absensi_per_siswa as $id_siswa => $absen_per_siswa) {
                $total_hadir = $absen_per_siswa->sum('k_hadir');
                $total_sakit = $absen_per_siswa->sum('k_sakit');
                $total_izin = $absen_per_siswa->sum('k_izin');
                $total_alpha = $absen_per_siswa->sum('k_alpha');

                // Simpan total absen ke dalam array
                $total_absen_per_siswa[$id_siswa] = [
                    'hadir' => $total_hadir,
                    'sakit' => $total_sakit,
                    'izin' => $total_izin,
                    'alpha' => $total_alpha,
                ];
            }
        } else {
            $detail_nilai1 = collect();
            $ekskul = "";
            $total_absen_per_siswa = collect();
        }

        // Render view PDF dan data
        return view('pdf/nilai', compact(
            'siswa', 
            'mapel', 
            'ekskul', 
            'mapelb', 
            'nilai1', 
            'detail_nilai1',
            'thn_ajaran',
            'total_absen_per_siswa'
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
            $ekskul = Ekskul::where('id', $nilai1->id_ekskul)->first();
            $detail_nilai1 = DetailNilai::where('id_nilai', $nilai1->kode_nilai)->get();
            $absensi = Absen::where('id_siswa', $id)
                ->where('semester', 2)
                ->get();

            // Lakukan pengelompokan berdasarkan ID siswa
            $absensi_per_siswa = $absensi->groupBy('id_siswa');

            // Inisialisasi array untuk menyimpan total absen per siswa
            $total_absen_per_siswa = [];

            // Hitung total absen untuk setiap siswa
            foreach ($absensi_per_siswa as $id_siswa => $absen_per_siswa) {
                $total_hadir = $absen_per_siswa->sum('k_hadir');
                $total_sakit = $absen_per_siswa->sum('k_sakit');
                $total_izin = $absen_per_siswa->sum('k_izin');
                $total_alpha = $absen_per_siswa->sum('k_alpha');

                // Simpan total absen ke dalam array
                $total_absen_per_siswa[$id_siswa] = [
                    'hadir' => $total_hadir,
                    'sakit' => $total_sakit,
                    'izin' => $total_izin,
                    'alpha' => $total_alpha,
                ];
            }
        } else {
            $detail_nilai1 = collect();
            $ekskul = "";
            $total_absen_per_siswa = collect();
        }

        // Render view PDF dan data
        return view('pdf/nilai2', compact(
            'siswa', 
            'kepsek', 
            'mapel', 
            'ekskul', 
            'mapelb', 
            'nilai1', 
            'detail_nilai1',
            'thn_ajaran',
            'total_absen_per_siswa'
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

            //-----TAMPIL NILAI SMT 1 dan 2
            if ($nilai1 !== null) {
                $absensi = Absen::where('id_siswa', $id)
                ->where('semester', 1)
                ->where('id_thn_ajaran', $thn_ajaran->id)
                ->get();

                // Lakukan pengelompokan berdasarkan ID siswa
                $absensi_per_siswa = $absensi->groupBy('id_siswa');

                // Inisialisasi array untuk menyimpan total absen per siswa
                $total_absen_per_siswa = [];

                // Hitung total absen untuk setiap siswa
                foreach ($absensi_per_siswa as $id_siswa => $absen_per_siswa) {
                    $total_hadir = $absen_per_siswa->sum('k_hadir');
                    $total_sakit = $absen_per_siswa->sum('k_sakit');
                    $total_izin = $absen_per_siswa->sum('k_izin');
                    $total_alpha = $absen_per_siswa->sum('k_alpha');

                    // Simpan total absen ke dalam array
                    $total_absen_per_siswa[$id_siswa] = [
                        'hadir' => $total_hadir,
                        'sakit' => $total_sakit,
                        'izin' => $total_izin,
                        'alpha' => $total_alpha,
                    ];
                }
                $detail_nilai1 = DetailNilai::where('id_nilai', $nilai1->kode_nilai)->get();
                $ekskul1 = Ekskul::where('id', $nilai1->id_ekskul)->first();
                
            } else {
                $detail_nilai1 = collect();
                $ekskul1 = "";
                $total_absen_per_siswa = collect();
            }

            if ($nilai2 !== null) {
                $detail_nilai2 = DetailNilai::where('id_nilai', $nilai2->kode_nilai)->get();
                $ekskul2 = Ekskul::where('id', $nilai2->id_ekskul)->first();
                $absensi2 = Absen::where('id_siswa', $id)
                ->where('semester', 2)
                ->where('id_thn_ajaran', $thn_ajaran->id)
                ->get();

                // Lakukan pengelompokan berdasarkan ID siswa
                $absensi_per_siswa2 = $absensi2->groupBy('id_siswa');

                // Inisialisasi array untuk menyimpan total absen per siswa
                $total_absen_per_siswa2 = [];

                // Hitung total absen untuk setiap siswa
                foreach ($absensi_per_siswa2 as $id_siswa => $absen_per_siswa) {
                    $total_hadir2 = $absen_per_siswa->sum('k_hadir');
                    $total_sakit2 = $absen_per_siswa->sum('k_sakit');
                    $total_izin2 = $absen_per_siswa->sum('k_izin');
                    $total_alpha2 = $absen_per_siswa->sum('k_alpha');

                    // Simpan total absen ke dalam array
                    $total_absen_per_siswa2[$id_siswa] = [
                        'hadir' => $total_hadir2,
                        'sakit' => $total_sakit2,
                        'izin' => $total_izin2,
                        'alpha' => $total_alpha2,
                    ];
                }
            } else {
                $detail_nilai2 = collect();
                $ekskul2 = $ekskul1;
                $total_absen_per_siswa2 = collect();
            }
            
            return view('wali_kelas/detail_nilai',
                [
                    'siswa' => $siswa,
                    'thn_ajaran' => $thn_ajaran,
                    'mapel' => $mapel,
                    'mapelb' => $mapelb,
                    'ekskul1' => $ekskul1,
                    'ekskul2' => $ekskul2,
                    'nilai1' => $nilai1,
                    'detail_nilai1' => $detail_nilai1,
                    'nilai2' => $nilai2,
                    'detail_nilai2' => $detail_nilai2,
                    'total_absen_per_siswa' => $total_absen_per_siswa,
                    'total_absen_per_siswa2' => $total_absen_per_siswa2,
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
        $mapelG = GuruMapel::where('id_guru',session('kode_guru'))->first();

        $nilai1 = Nilai::getJoinDetail()
            ->where('nilai.id_kelas',$id)
            ->where('nilai.semester', 1)
            ->where('dn.id_mapel', $mapelG->id_mapel)
            ->get();
        $nilai2 = Nilai::getJoinDetail()
            ->where('nilai.id_kelas',$id)
            ->where('nilai.semester', 2)
            ->where('dn.id_mapel', $mapelG->id_mapel)
            ->get();

         if ($nilai1 === null) {
            $nilai1 = collect();
            $total_absen_per_siswa = collect();
        }else{
            $absensi = Absen::
                where('semester', 1)
                ->where('id_mapel', $mapelG->id_mapel)
                ->where('id_thn_ajaran', $thn_ajaran->id)
                ->get();

            $absensi_per_siswa = $absensi->groupBy('id_siswa');

            $total_absen_per_siswa = [];

            foreach ($absensi_per_siswa as $id_siswa => $absen_per_siswa) {
                $total_hadir = $absen_per_siswa->sum('k_hadir');
                $total_sakit = $absen_per_siswa->sum('k_sakit');
                $total_izin = $absen_per_siswa->sum('k_izin');
                $total_alpha = $absen_per_siswa->sum('k_alpha');

                $total_absen_per_siswa[$id_siswa] = [
                    'hadir' => $total_hadir,
                    'sakit' => $total_sakit,
                    'izin' => $total_izin,
                    'alpha' => $total_alpha,
                ];
            }
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
                'total_absen_per_siswa' => $total_absen_per_siswa
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
