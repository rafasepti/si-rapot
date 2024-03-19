<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\Guru;
use App\Models\GuruMapel;
use App\Models\Mapel;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kelas/data_kelas',
            [
                
            ]
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
                        <a href="/kelas/edit/'.$b->id_kelas.'" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/kelas/hapus/'.$b->id_kelas.'" class="btn btn-outline-danger" onclick="return confirm(`Apakah anda yakin?`)">
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
        $guruBelumWaliKelas = Guru::whereDoesntHave('kelas')
            ->where('jabatan', "Guru")
            ->get();
        $guru = DB::table('guru')->where('jabatan', "Guru")->get();

        //dd($gurus);

        return view('kelas/tambah_kelas',[
            'guru' => $guru,
            'guruBelumWaliKelas' => $guruBelumWaliKelas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasRequest $request)
    {
        DB::table('kelas')->insert([
            'tingkat' => $request->tingkat,
            'id_walikelas' => $request->id_walikelas,
            'kelas' => $request->kelas,
        ]);
        return redirect('/kelas');
    }

    public function edit($id)
    {

        $waliKelasSaatIni = Kelas::findOrFail($id)->waliKelas;
        $kelas = DB::table('kelas')->where('id',$id)->get();
        $guru = Guru::
            where('jabatan', "Guru")
            ->get();
        return view('kelas/edit_kelas',
        [
            'kelas' => $kelas,
            'guru' => $guru,
            'waliKelasSaatIni' => $waliKelasSaatIni,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasRequest $request, Kelas $kelas)
    {
        DB::table('kelas')->where('id',$request->id)->update([
            'tingkat' => $request->tingkat,
            'id_walikelas' => $request->id_walikelas,
            'kelas' => $request->kelas,
        ]);
        return redirect('/kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('kelas')->where('id',$id)->delete();
        return redirect('/kelas');
    }
}
