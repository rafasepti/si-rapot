<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Http\Requests\StoreEkskulRequest;
use App\Http\Requests\UpdateEkskulRequest;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EkskulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ekskul/data_ekskul',
        );
    }

    public function ekskulGet(Request $request)
    {
        if ($request->ajax()) {
            $ekskul = Ekskul::join('guru as g', 'g.id', '=', 'ekskul.id_guru')
                ->select('ekskul.*', 'ekskul.id as idk','g.id as gd', 'g.*')
                ->get();
            return DataTables::of($ekskul)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/ekskul/edit/'.$b->idk.'" class="btn btn-outline-success" data-bs-toggle="tooltip" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/ekskul/hapus/'.$b->idk.'" class="btn btn-outline-danger" onclick="return confirm(`Apakah anda yakin?`)">
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
        $guru = Guru::whereDoesntHave('ekskul')
            ->where('jabatan', "Guru")
            ->get();
        //$guru = Guru::where('jabatan', 'Guru')->get();
        return view('ekskul/tambah_ekskul', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEkskulRequest $request)
    {
        DB::table('ekskul')->insert([
            'nama_ekskul' => $request->nama_ekskul,
            'id_guru' => $request->id_guru,
        ]);
        return redirect('/ekskul');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $guruSaatIni = Ekskul::findOrFail($id)->guru;
        $ekskul = DB::table('ekskul')->where('id',$id)->get();
        $guru = Guru::where('jabatan', 'Guru')->get();
        $guruBelumWaliKelas = Guru::whereDoesntHave('kelas')
            ->where('jabatan', "Guru")
            ->get();
        return view('ekskul/edit_ekskul',
        [
            'ekskul' => $ekskul,
            'guru' => $guru,
            'guruSaatIni' => $guruSaatIni,
            'guruBelumWaliKelas' => $guruBelumWaliKelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEkskulRequest $request, Ekskul $ekskul)
    {
        DB::table('ekskul')->where('id',$request->id)->update([
            'nama_ekskul' => $request->nama_ekskul,
            'id_guru' => $request->id_guru,
        ]);
        return redirect('/ekskul');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('ekskul')->where('id',$id)->delete();
        return redirect('/ekskul');
    }
}
