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
use Illuminate\Support\Facades\Validator;

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
                        <a href="/siswa/detail/'.$b->kode_siswa.'" class="btn btn-outline-info">
                            <i class="bi bi-info-lg"></i>
                        </a>
                        <a href="/siswa/edit/'.$b->kode_siswa.'" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/siswa/hapus/'.$b->kode_siswa.'" class="btn btn-outline-danger" onclick="return confirm(`Apakah anda yakin?`)">
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
        $siswa = DB::table('siswa')->insert([
            'kode_siswa' => $request->kode_siswa,
            'nisn' => $request->nisn,
            'id_kelas' => $request->id_kelas,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => date('y-m-d', strtotime($request->tgl_lahir)),
            'jk' => $request->jk,
            'agama' => $request->agama,
            'pendidikan_sebelum' => $request->pendidikan_sebelum,
            'alamat_siswa' => $request->alamat_siswa,
            'thn_angkatan' => $request->thn_angkatan,
        ]);

        //return response
        return json_encode(array(
            "statusCode"=>200
        ));

        //return redirect('/siswa');
    }

    public function storeWali(StoreSiswaRequest $request)
    {
        DB::table('wali')->insert([
            'id_siswa' => $request->id_siswa,
            'nama_wali' => $request->nama_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'alamat_wali' => $request->alamat_wali,
            'no_telp' => $request->no_telp,
            'sebagai' => $request->sebagai,
        ]);
        return redirect('/siswa');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswa = DB::table('siswa')->where('kode_siswa',$id)->get();
        $wali = DB::table('wali')->where('id_siswa',$id)->get();
        $kelas = Kelas::all();
        return view('siswa/edit_siswa',
        [
            'siswa' => $siswa,
            'wali' => $wali,
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
        DB::table('siswa')->where('kode_siswa',$request->id)->update([
            'nisn' => $request->nisn,
            'id_kelas' => $request->id_kelas,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => date('y-m-d', strtotime($request->tgl_lahir)),
            'jk' => $request->jk,
            'agama' => $request->agama,
            'pendidikan_sebelum' => $request->pendidikan_sebelum,
            'alamat_siswa' => $request->alamat_siswa,
            'thn_angkatan' => $request->thn_angkatan,
        ]);

        DB::table('wali')->where('id_siswa',$request->id)->update([
            'nama_wali' => $request->nama_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'alamat_wali' => $request->alamat_wali,
            'no_telp' => $request->no_telp,
            'sebagai' => $request->sebagai,
        ]);
        return redirect('/siswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('siswa')->where('kode_siswa',$id)->delete();
        DB::table('wali')->where('id_siswa',$id)->delete();
        return redirect('/siswa');
    }
}
