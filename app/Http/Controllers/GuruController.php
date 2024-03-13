<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\Mapel;

class GuruController extends Controller
{
    public function index()
    {
        return view('guru/data_guru',
            [
                
            ]
        );
    }

    public function guruGet(Request $request)
    {
        $guru = DB::table('guru')
                ->join('mapel', 'mapel.id', '=', 'guru.id_mapel')->get();
        if ($request->ajax()) {
            $guru = DB::table('guru')->get();
            return Datatables::of($guru)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/guru/edit/'.$b->id.'" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/guru/hapus/'.$b->id.'" class="btn btn-outline-danger" onclick="return confirm(`Apakah anda yakin?`)">
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
        $mapel = Mapel::all();
        return view('guru/tambah_guru',['mapel' => $mapel]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuruRequest $request)
    {
        DB::table('guru')->insert([
            'nuptk' => $request->nuptk,
            'id_mapel' => $request->id_mapel,
            'nama_guru' => $request->nama_guru,
            'alamat_guru' => $request->alamat_guru,
            'no_telp' => $request->no_telp,
        ]);
        return redirect('/guru');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $guru = DB::table('guru')->where('id',$id)->get();
        $mapel = Mapel::all();
        return view('guru/edit_guru',
        [
            'guru' => $guru,
            'mapel' => $mapel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        DB::table('guru')->where('id',$request->id)->update([
            'nuptk' => $request->nuptk,
            'id_mapel' => $request->id_mapel,
            'nama_guru' => $request->nama_guru,
            'alamat_guru' => $request->alamat_guru,
            'no_telp' => $request->no_telp,
        ]);
        return redirect('/guru');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('guru')->where('id',$id)->delete();
        return redirect('/guru');
    }
}
