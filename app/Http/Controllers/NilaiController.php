<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Http\Requests\StoreNilaiRequest;
use App\Http\Requests\UpdateNilaiRequest;
use App\Models\DetailNilai;
use Illuminate\Support\Facades\DB;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNilaiRequest $request)
    {
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

        foreach ($request->id_mapel as $key => $id_mapel) {
            // Jika data ditemukan, simpan ID guru_mapel ke dalam tabel guru_kelas
            $nilai_as = ($request->nilai_rl[$key]+$request->nilai_tp[$key])/2;
            $guruKelas = new DetailNilai();
            $guruKelas->id_nilai = $request->id_nilai;
            $guruKelas->id_mapel = $id_mapel; 
            $guruKelas->nilai_rl = $request->nilai_rl[$key]; 
            $guruKelas->nilai_tp = $request->nilai_tp[$key]; 
            $guruKelas->nilai_as = $nilai_as; 
            $guruKelas->ket = $request->ket[$key]; 
            $guruKelas->save();
        }
        return redirect('/kelaswali');
    }

    public function storeSiswa(StoreNilaiRequest $request)
    {
        foreach ($request->id_siswa as $key => $id_siswa) {
            $nilai_siswa = Nilai::where('id_siswa', $id_siswa)
            ->where('semester',$request->semester)
            ->where('id_kelas', $request->id_kelas)
            ->first();

            if($nilai_siswa){
                $nilai_as = ($request->nilai_rl[$key]+$request->nilai_tp[$key])/2;
                $guruKelas = new DetailNilai();
                $guruKelas->id_nilai = $nilai_siswa->kode_nilai;
                $guruKelas->id_mapel = $request->id_mapel; 
                $guruKelas->nilai_rl = $request->nilai_rl[$key]; 
                $guruKelas->nilai_tp = $request->nilai_tp[$key]; 
                $guruKelas->nilai_as = $nilai_as; 
                $guruKelas->ket = $request->ket[$key]; 
                $guruKelas->save();
            }else{
                $nilai_as = ($request->nilai_rl[$key]+$request->nilai_tp[$key])/2;
                $guruKelas = new DetailNilai();
                $guruKelas->id_nilai = Nilai::getkdNilai();
                $guruKelas->id_mapel = $request->id_mapel; 
                $guruKelas->nilai_rl = $request->nilai_rl[$key]; 
                $guruKelas->nilai_tp = $request->nilai_tp[$key]; 
                $guruKelas->nilai_as = $nilai_as; 
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

        return redirect('/kelaswali');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNilaiRequest $request, Nilai $nilai)
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
