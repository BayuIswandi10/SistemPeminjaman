<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\StoreRuanganRequest;
use App\Models\Fasilitas;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $ruangan = Ruangan::all();
        return view('ruangan.index',['ruangan'=>$ruangan]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fasilitas = Fasilitas::orderBy('nama_fasilitas', 'asc')->get()->pluck('nama_fasilitas', 'fasilitas_id');

        return view('ruangan.create',['fasilitas'=>$fasilitas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRuanganRequest $request)
    {
        $params = $request->validated();
        
        // Proses penyimpanan foto1
        $imageName1 = time() . '_1.' . $request->foto1->extension();
        $request->foto1->move(public_path('assets/foto/ruangan'), $imageName1);
        $imagePath1 = 'assets/foto/ruangan/' . $imageName1;
        
        // Proses penyimpanan foto2
        $imageName2 = time() . '_2.' . $request->foto2->extension();
        $request->foto2->move(public_path('assets/foto/ruangan'), $imageName2);
        $imagePath2 = 'assets/foto/ruangan/' . $imageName2;
        
        // Proses penyimpanan foto3
        $imageName3 = time() . '_3.' . $request->foto3->extension();
        $request->foto3->move(public_path('assets/foto/ruangan'), $imageName3);
        $imagePath3 = 'assets/foto/ruangan/' . $imageName3;
        
        // Proses penyimpanan foto4
        $imageName4 = time() . '_4.' . $request->foto4->extension();
        $request->foto4->move(public_path('assets/foto/ruangan'), $imageName4);
        $imagePath4 = 'assets/foto/ruangan/' . $imageName4;
        
        $params['created_by'] = Session::get('logged_in')->pengguna_id;
        if ($ruangan = Ruangan::create($params)) {
            $ruangan->fasilitas()->sync($params['fasilitas_ids']);
            $ruangan->foto1 = $imagePath1; // Atur atribut foto1        
            $ruangan->foto2 = $imagePath2; // Atur atribut foto2
            $ruangan->foto3 = $imagePath3; // Atur atribut foto3
            $ruangan->foto4 = $imagePath4; // Atur atribut foto4            
            $ruangan->save(); // Simpan perubahan
            return redirect(route('barang.index'))->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data. Silakan coba lagi.');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
