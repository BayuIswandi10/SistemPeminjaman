<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFasilitasRequest;
use App\Http\Requests\UpdateFasilitasRequest;
use App\Models\Fasilitas;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('fasilitas.index',['fasilitas'=>$fasilitas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fasilitas.create');    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFasilitasRequest $request)
    {
        $params = $request->validated();
        
        
        // Upload dan simpan gambar ke storage jika ada file yang diunggah
        if ($request->hasFile('foto_fasilitas')) {
            $image = $request->file('foto_fasilitas');
            $path = $image->store('fasilitas_photos');
            $params['foto_fasilitas'] = $path;
        }
        
        
        $params['created_by'] = Session::get('logged_in')->pengguna_id;
        if ($fasilitas = Fasilitas::create($params)) {
            return redirect(route('fasilitas.index'))->with('success', 'Data berhasil ditambahkan!');
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
        $fasilitas = Fasilitas::findOrFail($id);
        return view('fasilitas.edit', ['fasilitas' => $fasilitas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFasilitasRequest $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $params = $request->validated();
    
        $oldImagePath = $fasilitas->foto_fasilitas;
    
        if ($request->hasFile('foto_fasilitas')) {
            $image = $request->file('foto_fasilitas');
            
            // Simpan gambar baru
            $path = $image->store('fasilitas_photos');
            $params['foto_fasilitas'] = $path;
    
            if ($oldImagePath && Storage::exists($oldImagePath)) {
                // Hapus gambar lama dari storage jika ada
                Storage::delete($oldImagePath);
            }
        }
    
        // Lakukan pembaruan data mahasiswa
        $params['created_by'] = Session::get('logged_in')->pengguna_id;
        if ($fasilitas->update($params)) {
            return redirect(route('fasilitas.index'))->with('success', 'Updated!');
        } else {
            // Jika terjadi kesalahan saat pembaruan mahasiswa
            if ($request->hasFile('foto_fasilitas')) {
                $newImagePath = $params['foto_fasilitas'] ?? null;
                if ($newImagePath && Storage::exists($newImagePath)) {
                    Storage::delete($newImagePath);
                }
            }
    
            // Kembalikan ke halaman sebelumnya dengan pesan kesalahan
            return back()->with('error', 'Failed to update fasilitas.');
        }
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
