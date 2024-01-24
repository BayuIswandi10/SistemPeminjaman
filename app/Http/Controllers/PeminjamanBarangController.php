<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanBarangRequest;
use App\Http\Requests\UpdatePeminjamanBarangRequest;
use App\Models\Barang;
use App\Models\PeminjamanBarang;
use App\Models\Sesi;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PeminjamanBarangController extends Controller
{
    public function create()
    {
        $barang = Barang::where('status', 'Tersedia')
        ->orderBy('nama_barang', 'asc')
        ->get()
        ->pluck('nama_barang', 'barang_id');
        
        $sesi = Sesi::where('status', 'Aktif')->orderBy('nama_sesi', 'asc')->get()->pluck('nama_sesi', 'sesi_id');


        return view('peminjamanBarang.form_peminjamanBarang',['barang'=>$barang, 'sesi'=>$sesi]);
    }

    public function store(StorePeminjamanBarangRequest $request)
    {
        $params = $request->validated();
    
        $params['nama_peminjam'] = $_COOKIE['nama'];
        $params['nim_peminjaman'] = $_COOKIE['nim'];

        // Set nilai nomor pengajuan pada data request
        $params['no_pengajuan'] = $this->generateNomorPengajuan();
        
        $this->validateStockForAllBarangTypes($params['barang_ids'], $params['jumlah']);

        // Create peminjaman_barang
        $peminjamanBarang = PeminjamanBarang::create($params);

        // Inisialisasi waktu_kembali
        $peminjamanBarang->initializeWaktuKembali();
        $peminjamanBarang->save();
    
        $barangsData = [];
        foreach ($params['barang_ids'] as $index => $barangId) {
            $barangsData[$barangId] = [
                'jumlah' => $params['jumlah'][$index]
            ];
    

            $barang = Barang::find($barangId);
            if ($barang && $barang->tipe_barang == 'Konsumable') {
                $barang->kurangiStok($params['jumlah'][$index]);
            }
        }
    
        // Attach barangs to peminjaman_barang with quantities
        $peminjamanBarang->barang()->attach($barangsData);
    
        // Update status based on barang type
        $peminjamanBarang->updateStatusBasedOnBarangType();
    
        return redirect(route('peminjamanBarang.mahasiswa'))->with('success', 'Data berhasil ditambahkan!');
    }


    private function generateNomorPengajuan()
    {
        $prefix = 'PRGBG/';
        
        // Mendapatkan jumlah pengajuan yang sudah ada di database
        $countPengajuan = DB::table('peminjaman_barangs')->count() + 1;

        // Format tanggal sekarang
        $tanggalSekarang = now()->format('dmY');

        // Menggabungkan prefix, nomor urut, dan tanggal sekarang
        $nomorPengajuan = $prefix . str_pad($countPengajuan, 4, '0', STR_PAD_LEFT) . '/' . $tanggalSekarang;

        return $nomorPengajuan;
    }

    private function validateStockForAllBarangTypes(array $barangIds, array $quantities)
    {
        foreach ($barangIds as $index => $barangId) {
            $barang = Barang::find($barangId);
    
            if ($barang) {
                $requestedQuantity = $quantities[$index];
    
                if ($requestedQuantity > $barang->stok) {
                    throw ValidationException::withMessages([
                        'barang_ids.' . $index => 'Stok barang kurang.',
                    ]);
                }
            }
        }
    }    

    public function index()
    {
        $nimPeminjaman = isset($_COOKIE['nim']) ? $_COOKIE['nim'] : null;

        if ($nimPeminjaman) {
            $peminjamanBarang = PeminjamanBarang::with(['barang', 'sesi'])
                ->where('nim_peminjaman', $nimPeminjaman)
                ->get();
            return view('peminjamanBarang.pengembalian_barang', compact('peminjamanBarang'));
        } else {
            // Handle jika cookie NIM tidak ditemukan
            return redirect()->route('logins.loginMahasiswa')->with('error', 'Anda belum login atau sesi login telah berakhir.');
        }
    }

    public function riwayatPeminjamanBarang()
    {
        $peminjamanBarang = PeminjamanBarang::with(['barang', 'sesi'])->get();
        return view('riwayatPeminjaman.riwayatPeminjamanBarang', compact('peminjamanBarang'));
    }


    public function getPeminjamanBarangDetail($id)
    {
        $PeminjamanBarangDetail = DB::table('barangs as a')
            ->join('barang_peminjaman_barang as b', 'a.barang_id', '=', 'b.barang_id')
            ->select('b.*', 'a.nama_barang', 'a.gambar_barang')
            ->where('b.peminjaman_barang_id', $id)
            ->get();

        return $PeminjamanBarangDetail;
    }

    public function editBarangSebelum($id)
    {       
        $peminjamanBarang = PeminjamanBarang::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $PeminjamanBarangDetail = $this->getPeminjamanBarangDetail($id);
    
        return view('peminjamanBarang.form_barang_sebelum', ['peminjamanBarang' => $peminjamanBarang, 'sesi' => $sesi, 'PeminjamanBarangDetail' => $PeminjamanBarangDetail ]);
    }

    public function updateBarangSebelum(UpdatePeminjamanBarangRequest $request, $id)
    {       
        $peminjamanBarang = PeminjamanBarang::findOrFail($id);
        $params = $request->validated();
    
        // Simpan gambar baru
        if ($request->hasFile('foto_sebelum')) {
            $newImage = $request->file('foto_sebelum');
            $imageName = time() . '.' . $newImage->extension();
            $newImage->move(public_path('assets/foto/riwayat_barang'), $imageName);
            $newImagePath = 'assets/foto/riwayat_barang/' . $imageName;
    
            // Hapus gambar lama jika ada
            if ($peminjamanBarang->foto_sebelum && File::exists(public_path($peminjamanBarang->foto_sebelum))) {
                File::delete(public_path($peminjamanBarang->foto_sebelum));
            }
    
            $params['foto_sebelum'] = $newImagePath;
        }
        if ($peminjamanBarang->update($params)) {
            return redirect(route('riwayat_peminjaman_barang.mahasiswa'))->with('success', 'Updated!');
        } else {
            // Jika terjadi kesalahan saat pembaruan fasilitas
            return back()->with('error', 'Failed to update.');
        }
    }

    public function editBarangSesudah($id)
    {       
        $peminjamanBarang = PeminjamanBarang::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $PeminjamanBarangDetail = $this->getPeminjamanBarangDetail($id);
    
        return view('peminjamanBarang.form_barang_sesudah', ['peminjamanBarang' => $peminjamanBarang, 'sesi' => $sesi, 'PeminjamanBarangDetail' => $PeminjamanBarangDetail ]);
    }

    public function updateBarangSesudah(UpdatePeminjamanBarangRequest $request, $id)
    {       
        $peminjamanBarang = PeminjamanBarang::findOrFail($id);
        $params = $request->validated();
    
        // Simpan gambar baru
        if ($request->hasFile('foto_setelah')) {
            $newImage = $request->file('foto_setelah');
            $imageName = time() . '.' . $newImage->extension();
            $newImage->move(public_path('assets/foto/riwayat_barang'), $imageName);
            $newImagePath = 'assets/foto/riwayat_barang/' . $imageName;
    
            // Hapus gambar lama jika ada
            if ($peminjamanBarang->foto_setelah && File::exists(public_path($peminjamanBarang->foto_setelah))) {
                File::delete(public_path($peminjamanBarang->foto_setelah));
            }
    
            $params['foto_setelah'] = $newImagePath;
        }
        if ($peminjamanBarang->update($params)) {
            return redirect(route('riwayat_peminjaman_barang.mahasiswa'))->with('success', 'Updated!');
        } else {
            // Jika terjadi kesalahan saat pembaruan fasilitas
            return back()->with('error', 'Failed to update.');
        }
    }

    public function formDetail($id)
    {       
        $peminjamanBarang = PeminjamanBarang::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $PeminjamanBarangDetail = $this->getPeminjamanBarangDetail($id);
    
        return view('peminjamanBarang.form_barang_detail', ['peminjamanBarang' => $peminjamanBarang, 'sesi' => $sesi, 'PeminjamanBarangDetail' => $PeminjamanBarangDetail ]);
    }

    public function detailRiwayat($id)
    {       
        $peminjamanBarang = PeminjamanBarang::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $PeminjamanBarangDetail = $this->getPeminjamanBarangDetail($id);
    
        return view('riwayatPeminjaman.riwayatPeminjamanBarang_detail', ['peminjamanBarang' => $peminjamanBarang, 'sesi' => $sesi, 'PeminjamanBarangDetail' => $PeminjamanBarangDetail ]);
    }
}
