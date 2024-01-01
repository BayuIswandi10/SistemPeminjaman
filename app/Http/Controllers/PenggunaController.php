<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\Fasilitas;
use App\Models\Pengguna;
use App\Models\Sesi;
use App\Models\Ruangan;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanRuangan;

use App\Http\Requests\StorePenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;

use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengguna = Pengguna::all();
        return view('pengguna.index',['pengguna'=>$pengguna]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenggunaRequest $request)
    {
        $params = $request->validated();

        // Check if the username already exists
        $existingUsername = Pengguna::where('username', $request->username)->first();
        if ($existingUsername) {
            return redirect()->back()->with('error', 'Username sudah ada.')->withInput();
            // Redirect back to the create form with an error message
            // You can customize this based on your Swal.fire configuration
        }
        
        // Upload dan simpan gambar ke storage jika ada file yang diunggah
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $path=$image->store('pengguna_photos');
            $params['foto'] = $path;
            // Simpan lokasi gambar ke database
            // $pengguna->image = 'pengguna_images/' . $imageName;
            // $pengguna->save();
        }


        if ($pengguna = Pengguna::create($params)) {
            return redirect(route('pengguna.index'))->with('success', 'Data berhasil ditambahkan!');
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
        $pengguna = Pengguna::findOrFail($id);
        return view('pengguna.edit', ['pengguna' => $pengguna]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenggunaRequest $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $params = $request->validated();
    
        $oldImagePath = $pengguna->foto; // Kolom gambar pada tabel mahasiswa
    
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            
            // Simpan gambar baru
            $path = $image->store('pengguna_photos');
            $params['foto'] = $path;
    
            if ($oldImagePath && Storage::exists($oldImagePath)) {
                // Hapus gambar lama dari storage jika ada
                Storage::delete($oldImagePath);
            }
        }
    
        // Lakukan pembaruan data mahasiswa
        if ($pengguna->update($params)) {
            return redirect(route('pengguna.index'))->with('success', 'Updated!');
        } else {
            // Jika terjadi kesalahan saat pembaruan mahasiswa
            if ($request->hasFile('foto')) {
                $newImagePath = $params['foto'] ?? null;
                if ($newImagePath && Storage::exists($newImagePath)) {
                    Storage::delete($newImagePath);
                }
            }
    
            // Kembalikan ke halaman sebelumnya dengan pesan kesalahan
            return back()->with('error', 'Failed to update pengguna.');
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
        $pengguna = Pengguna::find($id);

        if ($pengguna) {
            $pengguna->status = 'Tidak Aktif';
            $pengguna->save();
    
            return redirect()->route('pengguna.index')->with('success', 'Data ID ' . $id . ' successfully set to inactive status.');
        }
    
        return redirect()->route('pengguna.index')->with('error', 'Data not found.');
    }
}
