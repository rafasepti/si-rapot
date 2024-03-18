<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\Mapel;
use App\Models\GuruMapel;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        return view('guru/data_guru',
        );
    }

    public function indexKS()
    {
        $count = Guru::getCountKepsek();
        //dd($count);
        $kepsek = DB::table('guru')->where('jabatan', "Kepala Sekolah")->get();
        return view('guru/data_kepsek',
            [
                'count' => $count,
                'kepsek' => $kepsek
            ]
        );
    }

    public function loadKepsek()
    {
        $data = DB::table('guru')->where('jabatan', "Kepala Sekolah")->get(); // Ganti YourModel dengan model Anda

        return response()->json($data);
    }


    public function guruGet(Request $request)
    {
        if ($request->ajax()) {
            $guru = DB::table('guru')->where('jabatan', "Guru")->get();
           // $guru = Guru::getJoinMapel();
            return Datatables::of($guru)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/guru/detail/'.$b->kode_guru.'" class="btn btn-outline-info">
                            <i class="bi bi-info-lg"></i>
                        </a>
                        <a href="/guru/edit/'.$b->kode_guru.'" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/guru/hapus/'.$b->kode_guru.'" class="btn btn-outline-danger" onclick="return confirm(`Apakah anda yakin?`)">
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
        $kode_guru = Guru::getIdGuru();
        $mapel = Mapel::all();
        return view('guru/tambah_guru',[
            'mapel' => $mapel,
            'kode_guru' => $kode_guru,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuruRequest $request)
    {
        DB::table('guru')->insert([
            'kode_guru' => $request->id_guru,
            'nuptk' => $request->nuptk,
            'id_mapel' => $request->id_mapel,
            'nama_guru' => $request->nama_guru,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            'jabatan' => "Guru",
            'alamat_guru' => $request->alamat_guru,
            'no_telp' => $request->no_telp,
        ]);

         //Mapel Guru
         $request->validate([
            'options.*' => 'required', // Setidaknya satu opsi harus dipilih
        ]);
        // Proses menyimpan data
        $options = $request->options ?? [];
        // Simpan data ke dalam database atau lakukan sesuatu dengan data tersebut
        foreach ($options as $option) {
            GuruMapel::create([
                'id_guru' => $request->id_guru,
                'id_mapel' => $option,
            ]);
        }
        
        return redirect('/guru');
    }

    public function storeKS(StoreGuruRequest $request)
    {
        $count = Guru::getCountKepsek();
        if($count >= 1){
            DB::table('guru')->where('id',$request->id)->update([
                'nuptk' => $request->nuptk,
                'nama_guru' => $request->nama_guru,
                'jabatan' => "Kepala Sekolah",
                'email' => $request->email,
                'alamat_guru' => $request->alamat_guru,
                'no_telp' => $request->no_telp,
            ]);
        }else{
            DB::table('guru')->insert([
                'nuptk' => $request->nuptk,
                'nama_guru' => $request->nama_guru,
                'jabatan' => "Kepala Sekolah",
                'email' => $request->email,
                'password' => Hash::make($request->input('password')),
                'alamat_guru' => $request->alamat_guru,
                'no_telp' => $request->no_telp,
            ]);
        }

        //return response
        return response()->json(
            [
                'status' => 200,
                'message' => 'Sukses Input Data',
            ]
        );
    }

    public function detail($id)
    {
        $guru = Guru::getJoinMapelId($id);
        return view('guru/detail_guru',
        [
            'guru' => $guru,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $guru = DB::table('guru')->where('kode_guru',$id)->get();
        $mapel = Mapel::all();
        $gurum = GuruMapel::where('id_guru',$id);
        return view('guru/edit_guru',
        [
            'guru' => $guru,
            'gurum' => $gurum,
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
            'email' => $request->email,
            'jabatan' => "Guru",
            'alamat_guru' => $request->alamat_guru,
            'no_telp' => $request->no_telp,
        ]);
        
        // Tabel GuruMapel
        $request->validate([
            'options.*' => 'nullable', // Karena tidak semua checkbox harus dipilih
        ]);
        // Dapatkan data yang akan diperbarui dari database
        $gurum = GuruMapel::where('id_guru',$request->kode_guru)->firstOrFail();

        $options = $request->options ?? [];

        if ($options) {
            foreach ($options as $option) {
                $gm = GuruMapel::firstOrCreate([
                    'id_guru' => $request->kode_guru,
                    'id_mapel' => $option
                ]);
            }
            GuruMapel::where('id_guru', $request->kode_guru)->whereNotIn('id_mapel', $options)->delete();
        } else {
            GuruMapel::where('id_guru', $request->kode_guru)->delete();
        }
        
        // // Bandingkan checkbox yang di-submit dengan checkbox yang sudah ada di database
        // $checkboxesFromForm = $request->options ?? [];
        // $checkboxesFromDatabase = $gurum->id_mapel ?? [];
        
        // // Tentukan checkbox mana yang harus ditambahkan, dihapus, atau dibiarkan seperti itu
        // $checkboxesToAdd = array_diff($checkboxesFromForm, $checkboxesFromDatabase);
        // $checkboxesToRemove = array_diff($checkboxesFromDatabase, $checkboxesFromForm);
        
        // // Tambahkan checkbox yang baru ditambahkan
        // foreach ($checkboxesToAdd as $option) {
        //     $gurum->id_guru[] = $request->kode_guru;
        //     $gurum->id_mapel[] = $option;
        // }
        // // Hapus checkbox yang dihapus
        // foreach ($checkboxesToRemove as $option) {
        //     $index = array_search($option, $gurum->id_mapel);
        //     if ($index !== false) {
        //         unset($gurum->id_mapel[$index]);
        //     }
        // }
        // Simpan perubahan
        $gurum->save();

        return redirect('/guru');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('guru')->where('kode_guru',$id)->delete();
        return redirect('/guru');
    }
}
