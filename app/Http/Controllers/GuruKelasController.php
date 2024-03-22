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
use Yajra\DataTables\DataTables;

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
            return DataTables::of($kelas)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $exists = GuruKelas::where('id_kelas', $b->id_kelas)->exists();
                    if ($exists) {
                        $actionBtn = 
                        '
                        <a href="/guru_kelas/edit/'.$b->id_kelas.'" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        ';
                    } else {
                        $actionBtn = 
                        '
                        <a href="/guru_kelas/tambah/'.$b->id_kelas.'" class="btn btn-outline-primary">
                            <i class="bi bi-plus"></i>
                        </a>
                        ';
                    }
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
        //$mapel = Mapel::where('kategori', 1)->get();
        
        $mapel = GuruKelas::getJoinId($id);

        $kelas = Kelas::where('id', $id)->get();

        // Mengambil semua guru dan mengelompokkannya berdasarkan mata pelajaran yang diajarkannya
        $gurus =  Guru::getGroupSelect();

        return view('guru_kelas/tambah_gurukls',[
            'id_kelas' => $id,
            'kelas' => $kelas,
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

    public function edit($id)
    {
        // Mengambil semua mata pelajaran
        $gk = GuruKelas::getJoinId($id);
        //$mapels = GuruMapel::getJoinMapelKat();
        $mapels = Mapel::where('kategori', 2)->get();
        $kelas = Kelas::where('id', $id)->get();
        $gurus =  Guru::getGroupSelect();
        
        return view('guru_kelas/edit_gurukls',[
            'id_kelas' => $id,
            'kelas' => $kelas,
            'gk' => $gk,
            'mapels' => $mapels,
            'gurus' => $gurus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuruKelasRequest $request, GuruKelas $guruKelas)
    {
        $request->validate([
            'id_mapel.*' => 'required|exists:mapel,id', // Validasi untuk id_mapel
            'id_guru.*' => 'required|exists:guru_mapel,id', // Validasi untuk id_guru
        ]);

        GuruKelas::where('id_kelas', $request->id_kelas)->delete();
    
        // Simpan data ke dalam database
        foreach ($request->id_mapel as $key => $id_mapel) {
            $guruKelas = new GuruKelas();
            $guruKelas->id_kelas = $request->id_kelas;
            $guruKelas->id_gm = $request->id_guru[$key]; // Gunakan ID dari hasil kueri
            $guruKelas->save();
        }

        return redirect('/guru_kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuruKelas $guruKelas)
    {
        //
    }
}
