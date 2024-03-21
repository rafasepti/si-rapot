<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Http\Requests\StoreTahunAjaranRequest;
use App\Http\Requests\UpdateTahunAjaranRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thn_aktif = TahunAjaran::where('aktif','Ya')->first();
        return view('tahun_ajaran/data_tahunajaran',
            compact('thn_aktif')
        );
    }

    public function tahunGet(Request $request)
    {
        if ($request->ajax()) {
            $thn = DB::table('tahun_ajaran')->get();
            return Datatables::of($thn)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/tahunajaran/aktif/'.$b->id.'" class="btn btn-outline-primary" data-bs-toggle="tooltip" title="pilih">
                            <i class="bi bi-check"></i>
                        </a>
                        <a href="/tahunajaran/edit/'.$b->id.'" class="btn btn-outline-success" data-bs-toggle="tooltip" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/tahunajaran/hapus/'.$b->id.'" class="btn btn-outline-danger" onclick="return confirm(`Apakah anda yakin?`)">
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
        return view('tahun_ajaran/tambah_tahunajaran');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTahunAjaranRequest $request)
    {
        DB::table('tahun_ajaran')->insert([
            'nama_tahun' => $request->nama_tahun,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
        ]);
        return redirect('/tahunajaran');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $thn = DB::table('tahun_ajaran')->where('id',$id)->get();
        return view('tahun_ajaran/edit_tahunajaran',
        [
            'thn' => $thn,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTahunAjaranRequest $request, TahunAjaran $tahunAjaran)
    {
        DB::table('tahun_ajaran')->where('id',$request->id)->update([
            'nama_tahun' => $request->nama_tahun,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
        ]);
        return redirect('/tahunajaran');
    }

    public function aktif($id)
    {
        DB::table('tahun_ajaran')->update([
            'aktif' => "tidak",
        ]);
        DB::table('tahun_ajaran')->where('id',$id)->update([
            'aktif' => "Ya",
        ]);
        return redirect('/tahunajaran');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('tahun_ajaran')->where('id',$id)->delete();
        return redirect('/tahunajaran');
    }
}
