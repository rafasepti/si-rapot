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
        $kelas= Kelas::all();
        return view('siswa/data_siswa',
            [
                'kelas' => $kelas,
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

    public function filter(Request $request)
    {
        $siswa = Siswa::getJoinKelas();

        if ($request->id_kelas) {
            $siswa->where('s.id_kelas', $request->id_kelas);
        }

        $siswa = $siswa->get();

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
        if($request->nisn != ''){
            $siswa = DB::table('siswa')->insert([
                'kode_siswa' => $request->kode_siswa,
                'nama_siswa' => $request->nama_siswa,
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
            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Sukses Input Data',
                ]
            );
        } 
        else{
            DB::table('wali')->insert([
                'id_siswa' => $request->id_siswa,
                'nama_wali' => $request->nama_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
                'alamat_wali' => $request->alamat_wali,
                'no_telp' => $request->no_telp,
                'sebagai' => $request->sebagai,
            ]);

            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Sukses Input Data',
                ]
            );
        }

        //return redirect('/siswa/tambah');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswa = DB::table('siswa')->where('kode_siswa',$id)->get();
        $wali = DB::table('wali')->where('id_siswa',$id)->get();
        $kelas = Kelas::all();
        $kode_siswa = $id;
        $countWali = Wali::getCountWali($id);
        //dd($countWali);
        return view('siswa/edit_siswa',
        [
            'siswa' => $siswa,
            'wali' => $wali,
            'kelas' => $kelas,
            'kode_siswa' => $kode_siswa,
            'countWali' => $countWali,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        if($request->nisn != ''){
            $siswa = DB::table('siswa')->where('kode_siswa',$request->kode_siswa)->update([
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
            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Sukses Update Data',
                ]
            );
        } 
        else{
            if($request->tipe == "update"){
                DB::table('wali')->where('id',$request->id_wali)->update([
                    'nama_wali' => $request->nama_wali,
                    'pekerjaan_wali' => $request->pekerjaan_wali,
                    'alamat_wali' => $request->alamat_wali,
                    'no_telp' => $request->no_telp,
                    'sebagai' => $request->sebagai,
                ]);
            }elseif($request->tipe == "tambah"){
                DB::table('wali')->insert([
                    'id_siswa' => $request->id_siswa,
                    'nama_wali' => $request->nama_wali,
                    'pekerjaan_wali' => $request->pekerjaan_wali,
                    'alamat_wali' => $request->alamat_wali,
                    'no_telp' => $request->no_telp,
                    'sebagai' => $request->sebagai,
                ]);
            }

            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Sukses Update Data',
                ]
            );
        }
    }

    public function detail($id)
    {
        $siswa = Siswa::getJoinKelasId($id);
        $wali = DB::table('wali')
                ->where('id_siswa', $id)
                ->get();
        return view('siswa/detail_siswa',
        [
            'siswa' => $siswa,
            'wali' => $wali,
        ]);
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

    public function nilai()
    {
        $kelas= Kelas::all();
        return view('wali_kelas/tambah_nilai',
            [
                'kelas' => $kelas,
            ]
        );
    }
}
