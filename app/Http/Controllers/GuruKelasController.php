<?php

namespace App\Http\Controllers;

use App\Models\GuruKelas;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;
use App\Http\Requests\StoreGuruKelasRequest;
use App\Http\Requests\UpdateGuruKelasRequest;
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
                        <a href="/guru_kelas/tambah/'.$b->id_kelas.'" class="btn btn-primary">
                           Tambah Mata Pelajaran
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

        // Mengambil semua guru dan mengelompokkannya berdasarkan mata pelajaran yang diajarkannya
        $gurus =  Guru::getGroupSelect();

        return view('guru_kelas/tambah_gurukls',[
            'id' => $id,
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
        //
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
