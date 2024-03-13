<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Http\Requests\StoreMapelRequest;
use App\Http\Requests\UpdateMapelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mapel/data_mapel',
            [
                
            ]
        );
    }

    public function mapelGet(Request $request)
    {
        if ($request->ajax()) {
            $mapel = DB::table('mapel')->get();
            return Datatables::of($mapel)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/siswa/edit/" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/siswa/hapus/" class="btn btn-outline-danger" onclick="return confirm(`Apakah anda yakin?`)">
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
        return view('mapel/tambah_mapel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMapelRequest $request)
    {
        DB::table('mapel')->insert([
            'nama_mapel' => $request->nama_mapel,
            'kkm' => $request->kkm,
        ]);
        return redirect('/mapel');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMapelRequest $request, Mapel $mapel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        //
    }
}
