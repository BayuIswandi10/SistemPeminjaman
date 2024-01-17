<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanRuanganRequest;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use App\Models\Sesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {       
        $ruangan = Ruangan::findOrFail($id);
        $sesi = Sesi::where('status', 'Aktif')->orderBy('nama_sesi', 'asc')->get()->pluck('nama_sesi', 'sesi_id');

        // Pastikan variabel $ruangan bukan boolean (false)
        if (!$ruangan instanceof Ruangan) {
            // Lakukan penanganan kesalahan di sini, misalnya:
            return redirect()->route('route_name')->with('error', 'Ruangan tidak ditemukan');
        }

        $fasilitasDetail = $this->getFasilitasDetail($id);
    
        return view('peminjamanRuangan.form_peminjamanRuangan', ['ruangan' => $ruangan, 'fasilitasDetail' => $fasilitasDetail, 'sesi' => $sesi]);
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

    public function store(StorePeminjamanRuanganRequest $request)
    {
        $params = $request->validated();

        $params['nama_peminjam'] = $_COOKIE['nama'];
        $params['nim_peminjaman'] = $_COOKIE['nim'];
        
        // Set nilai nomor pengajuan pada data request
        $params['no_pengajuan'] = $this->generateNomorPengajuan();

        if ($pengguna = PeminjamanRuangan::create($params)) {
            return redirect(route('peminjamanRuangan.mahasiswa'))->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data. Silakan coba lagi.');
        }

        return redirect()->route('peminjamanRuangan.mahasiswa')->with('success', 'Peminjaman ruangan berhasil ditambahkan!');
    }

    private function generateNomorPengajuan()
    {
        $prefix = 'PRGNG/';
        
        // Mendapatkan jumlah pengajuan yang sudah ada di database
        $countPengajuan = DB::table('peminjaman_ruangans')->count() + 1;

        // Format tanggal sekarang
        $tanggalSekarang = now()->format('dmY');

        // Menggabungkan prefix, nomor urut, dan tanggal sekarang
        $nomorPengajuan = $prefix . str_pad($countPengajuan, 2, '0', STR_PAD_LEFT) . '/' . $tanggalSekarang;

        return $nomorPengajuan;
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
