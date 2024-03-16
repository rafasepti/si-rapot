<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\Kelas;
use App\Models\Wali;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('siswa/data_siswa',
            [
                
            ]
        );
    }

    public function siswaGet(Request $request)
    {
        if ($request->ajax()) {
            $siswa = Siswa::getJoinKelas();
            return Datatables::of($siswa)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/siswa/detail/'.$b->id_siswa.'" class="btn btn-outline-info">
                            <i class="bi bi-info-lg"></i>
                        </a>
                        <a href="/siswa/edit/'.$b->id_siswa.'" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/siswa/hapus/'.$b->id_siswa.'" class="btn btn-outline-danger" onclick="return confirm(`Apakah anda yakin?`)">
                            <i class="bi bi-trash-fill"></i>
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
        $kelas = Kelas::all();
        $kode_siswa = Siswa::getIdSiswa();
        return view('siswa/tambah_siswa',[
            'kelas' => $kelas,
            'kode_siswa' => $kode_siswa
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {
        DB::table('siswa')->insert([
            'nuptk' => $request->nuptk,
            'id_mapel' => $request->id_mapel,
            'nama_siswa' => $request->nama_siswa,
            'alamat_siswa' => $request->alamat_siswa,
            'no_telp' => $request->no_telp,
        ]);
        return redirect('/siswa');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswa = DB::table('siswa')->where('id',$id)->get();
        $kelas = Kelas::all();
        return view('siswa/edit_siswa',
        [
            'siswa' => $siswa,
            'kelas' => $kelas,
        ]);
    }

    public function detail($id)
    {
        $siswa = siswa::getJoinMapelId($id);
        return view('siswa/detail_siswa',
        [
            'siswa' => $siswa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        DB::table('siswa')->where('id',$request->id)->update([
            'nuptk' => $request->nuptk,
            'id_mapel' => $request->id_mapel,
            'nama_siswa' => $request->nama_siswa,
            'alamat_siswa' => $request->alamat_siswa,
            'no_telp' => $request->no_telp,
        ]);
        return redirect('/siswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('siswa')->where('id',$id)->delete();
        return redirect('/siswa');
    }
}
