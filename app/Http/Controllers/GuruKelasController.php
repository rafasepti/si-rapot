<?php

namespace App\Http\Controllers;

use App\Models\GuruKelas;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;
use App\Http\Requests\StoreGuruKelasRequest;
use App\Http\Requests\UpdateGuruKelasRequest;
use App\Models\GuruMapel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DataTables;

class GuruKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('guru_kelas/data_gurukls',
        );
    }

    public function kelasGet(Request $request)
    {
        if ($request->ajax()) {
            $kelas = Kelas::getJoinGuru();
            return Datatables::of($kelas)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                    <a href="/guru_kelas/tambah/'.$b->id_kelas.'" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Mengambil semua mata pelajaran
        $mapels = Mapel::where('kategori', 2)->get();
        $mapel = Mapel::where('kategori', 1)->get();

        $kelas = Kelas::where('id', $id)->get();

        // Mengambil semua guru dan mengelompokkannya berdasarkan mata pelajaran yang diajarkannya
        $gurus =  Guru::getGroupSelect();

        $exists = GuruKelas::where('id_kelas', $id)->exists();
        if ($exists) {
            $ex = "ada";
        } else {
            // Jika tidak ada baris dengan id_kelas yang sesuai
            $ex = "";
        }

        return view('guru_kelas/tambah_gurukls',[
            'id_kelas' => $id,
            'kelas' => $kelas,
            'ex' => $ex,
            'mapels' => $mapels,
            'mapel' => $mapel,
            'gurus' => $gurus,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuruKelasRequest $request)
    {
        $request->validate([
            'id_mapel.*' => 'required|exists:mapel,id', // Validasi untuk id_mapel
            'id_guru.*' => 'required|exists:guru,kode_guru', // Validasi untuk id_guru
        ]);
    
        // Simpan data ke dalam database
        foreach ($request->id_mapel as $key => $id_mapel) {
            $gm = GuruMapel::where('id_mapel',$id_mapel)
                ->where('id_guru',$request->id_guru[$key])
                ->first();

                if ($gm) {
                    // Jika data ditemukan, simpan ID guru_mapel ke dalam tabel guru_kelas
                    $guruKelas = new GuruKelas();
                    $guruKelas->id_kelas = $request->id_kelas;
                    $guruKelas->id_gm = $gm->id; // Gunakan ID dari hasil kueri
                    $guruKelas->save();
                }
        }

        return redirect('/guru_kelas');
    }

    /**
     * Display the specified resource.
     */
    public function show(GuruKelas $guruKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GuruKelas $guruKelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuruKelasRequest $request, GuruKelas $guruKelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuruKelas $guruKelas)
    {
        //
    }
}
