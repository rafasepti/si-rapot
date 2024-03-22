<?php

namespace App\Http\Controllers;

use App\Models\Wali;
use App\Http\Requests\StoreWaliRequest;
use App\Http\Requests\UpdateWaliRequest;
use App\Models\GuruKelas;
use App\Models\Kelas;
use Illuminate\Http\Request;
//use DataTables;
use App\Models\Siswa;
use Illuminate\Contracts\Session\Session;
use Yajra\DataTables\DataTables as DataTables;

class WaliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(session('walikelas')=="Ya"){
            $id_user = session('id_user');
            $siswa_kel = Siswa::getJoinKId($id_user)->first();
            if($siswa_kel == ""){
                $siswa_kel = "";
            }
            return view('wali_kelas/data_sw',
                compact('siswa_kel')
            );
        }else{
            return view('wali_kelas/data_kls');
        }
    }

    public function indexGuru()
    {
        
    }

    public function siswaGet(Request $request)
    {
        if ($request->ajax()) {
            $id_user = session('id_user');
            $siswa = Siswa::getJoinKId($id_user)->get();
            return DataTables::of($siswa)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/nilai/tambah/'.$b->id_siswa.'" class="btn btn-success">
                            <i class="bi bi-plus"></i>
                        </a>
                        <a href="/nilai/detail/'.$b->id_siswa.'" class="btn btn-primary">
                            <i class="bi bi-info-lg"></i>
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function kelasGet(Request $request)
    {
        if ($request->ajax()) {
            $kelas = GuruKelas::getKelasDiajar(session('id_user'));
            return Datatables::of($kelas)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                    <a href="/nilai/tambah/'.$b->ids_kelas.'" class="btn btn-success">
                        <i class="bi bi-plus"></i>
                    </a>
                    <a href="/nilai/detail/'.$b->ids_kelas.'" class="btn btn-primary">
                        <i class="bi bi-info-lg"></i>
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
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWaliRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Wali $wali)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wali $wali)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWaliRequest $request, Wali $wali)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wali $wali)
    {
        //
    }
}
