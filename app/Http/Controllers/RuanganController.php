<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRuanganRequest;
use App\Models\Fasilitas;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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

    public function detail($id)
    {       
        $ruangan = Ruangan::findOrFail($id);
        
        // Pastikan variabel $ruangan bukan boolean (false)
        if (!$ruangan instanceof Ruangan) {
            // Lakukan penanganan kesalahan di sini, misalnya:
            return redirect()->route('route_name')->with('error', 'Ruangan tidak ditemukan');
        }

        $fasilitasDetail = $this->getFasilitasDetail($id);
    
        return view('ruangan.detail', ['ruangan' => $ruangan, 'fasilitasDetail' => $fasilitasDetail]);
    }
    
    public function getFasilitasDetail($id)
    {
        $fasilitasDetail = DB::table('fasilitas as a')
            ->join('fasilitas_ruangan as b', 'a.fasilitas_id', '=', 'b.fasilitas_id')
            ->select('b.*', 'a.nama_fasilitas', 'a.foto_fasilitas')
            ->where('b.ruangan_id', $id)
            ->get();

        return $fasilitasDetail;
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
    
        $pengguna = Session::get('logged_in');
        $params['created_by'] = $pengguna->pengguna_id;
    
        $ruangan = Ruangan::create($params);
    
        if ($ruangan) {
            // Menyimpan fasilitas yang dipilih
            $fasilitasData = [];
            foreach ($params['fasilitas_ids'] as $index => $fasilitasId) {
                $fasilitasData[$fasilitasId] = [
                    'jumlah' => $params['jumlah'][$index],
                    'status' => 'Aktif'
                ];
            }
    
            // Menyimpan relasi antara ruangan dan fasilitas di tabel pivot
            $ruangan->fasilitas()->attach($fasilitasData);
    
            // Menyimpan lokasi foto ke dalam model ruangan yang baru dibuat
            $ruangan->foto1 = $imagePath1;
            $ruangan->foto2 = $imagePath2;
            $ruangan->foto3 = $imagePath3;
            $ruangan->foto4 = $imagePath4;
            $ruangan->save();
    
            return redirect(route('ruangan.index'))->with('success', 'Data berhasil ditambahkan!');
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
        $ruangan = Ruangan::findOrFail($id);
        $fasilitas = Fasilitas::orderBy('nama_fasilitas', 'asc')->get()->pluck('nama_fasilitas', 'fasilitas_id');
        return view('ruangan.edit', ['ruangan' => $ruangan,'fasilitas'=>$fasilitas]);
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
