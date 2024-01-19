<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanRuanganRequest;
use App\Http\Requests\UpdatePeminjamanRuanganRequest;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanRuangan;
use Illuminate\Support\Facades\File;
use App\Models\Ruangan;
use App\Models\Sesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    public function index()
    {
        $nimPeminjaman = isset($_COOKIE['nim']) ? $_COOKIE['nim'] : null;

        if ($nimPeminjaman) {
            $peminjamanRuangan = PeminjamanRuangan::with(['ruangan', 'sesi'])
                ->where('nim_peminjaman', $nimPeminjaman)
                ->get();
            return view('peminjamanRuangan.pengembalian_ruangan', compact('peminjamanRuangan'));
        } else {
            // Handle jika cookie NIM tidak ditemukan
            return redirect()->route('logins.loginMahasiswa')->with('error', 'Anda belum login atau sesi login telah berakhir.');
        }
    }

    public function riwayatPeminjamanRuangan()
    {
        $peminjamanRuangan = PeminjamanRuangan::with(['ruangan', 'sesi'])->get();
        return view('riwayatPeminjaman.riwayatPeminjamanRuangan', compact('peminjamanRuangan'));
    }

    public function destroy($id)
    {
        $PeminjamanRuangan = PeminjamanRuangan::find($id);
    
        if ($PeminjamanRuangan) {
            $PeminjamanRuangan->status = 'Ditolak';
            $PeminjamanRuangan->pengguna_id = Session::get('logged_in')->pengguna_id;
            $PeminjamanRuangan->save();
    
            return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('success', 'Data ID ' . $id . ' successfully set to inactive status.');
        }
    
        return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('error', 'Data not found.');
    }
    public function acc($id)
    {
        $PeminjamanRuangan = PeminjamanRuangan::find($id);
        if ($PeminjamanRuangan) {
            $PeminjamanRuangan->status = 'Disetujui';
            $PeminjamanRuangan->pengguna_id = Session::get('logged_in')->pengguna_id;
            $PeminjamanRuangan->save();
    
            return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('success', 'Data ID ' . $id . ' successfully set to inactive status.');
        }
    
        return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('error', 'Data not found.');
    }

    public function editRuanganSebelum($id)
    {       
        $peminjamanRuangan = PeminjamanRuangan::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $ruangan = Ruangan::orderBy('nama_ruangan', 'asc')
        ->get()
        ->pluck('nama_ruangan', 'ruangan_id');
    
        return view('peminjamanRuangan.form_ruangan_sebelum', ['peminjamanRuangan' => $peminjamanRuangan, 'sesi' => $sesi, 'ruangan' => $ruangan ]);
    }

    public function updateRuanganSebelum(UpdatePeminjamanRuanganRequest $request, $id)
    {       
        $peminjamanRuangan = PeminjamanRuangan::findOrFail($id);
        $params = $request->validated();
    
        // Simpan gambar baru
        if ($request->hasFile('foto_sebelum')) {
            $newImage = $request->file('foto_sebelum');
            $imageName = time() . '.' . $newImage->extension();
            $newImage->move(public_path('assets/foto/riwayat_ruangan'), $imageName);
            $newImagePath = 'assets/foto/riwayat_ruangan/' . $imageName;
    
            // Hapus gambar lama jika ada
            if ($peminjamanRuangan->foto_sebelum && File::exists(public_path($peminjamanRuangan->foto_sebelum))) {
                File::delete(public_path($peminjamanRuangan->foto_sebelum));
            }
    
            $params['foto_sebelum'] = $newImagePath;
        }
        if ($peminjamanRuangan->update($params)) {
            return redirect(route('riwayat_peminjaman_ruangan.mahasiswa'))->with('success', 'Updated!');
        } else {
            // Jika terjadi kesalahan saat pembaruan fasilitas
            return back()->with('error', 'Failed to update.');
        }
    }
}