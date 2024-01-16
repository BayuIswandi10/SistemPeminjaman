<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanRuangan;
use App\Models\Pengguna;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Dashboard.dashboard');
    }

    public function indexMahasiswa()
    {
        return view('Dashboard.dashboardMahasiswa');
    }

    public function showLoginForm()
    {
        return view('auth.loginMahasiswa');
    }

    public function member()
    {
        $pengguna = Pengguna::whereIn('role', ['Koor UPT', 'PIC Lab', 'Admin Lab 1', 'Admin Lab 2'])->get();
        return view('member.index', ['pengguna' => $pengguna]);
    }

    public function ruangan()
    {       
        $ruangan = Ruangan::all();
        return view('peminjamanRuangan.index',['ruangan'=>$ruangan]);
        
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
    
        return view('peminjamanRuangan.detail', ['ruangan' => $ruangan, 'fasilitasDetail' => $fasilitasDetail]);
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

    public function barang()
    {
        $barang = Barang::all();
        return view('peminjamanBarang.index',['barang'=>$barang]);
    }

    public function beranda()
    {
        $ruanganData = Ruangan::where('status', 'Aktif')->count();
        $barangData = Barang::where('status', 'Aktif')->count(); 
        $peminjamanruanganData = PeminjamanRuangan::where('status', 'Aktif')->count();
        $peminjamanbarangData = PeminjamanBarang::where('status', 'Aktif')->count(); 
    
        $chartRuangan = $this->ChartRuangan(); // Assuming this function returns the correct data
        $chartBarang = $this->ChartBarang(); // Assuming this function returns the correct data
        $pieChart = $this->PieChart(); // Assuming this function returns the correct data
    
        // Retrieve other necessary data...
    
        return view('Dashboard.beranda', compact('ruanganData', 'barangData', 'chartRuangan', 'chartBarang', 'pieChart', 'peminjamanruanganData','peminjamanbarangData' ));
    }
    

    public function ChartRuangan()
    {
        // Implement your logic to retrieve Ruangan chart data
        // Example:
        $chartData = [
            'labelbulan' => ['January', 'February', 'March'],
            'namaruangan' => ['Room A', 'Room B', 'Room C'],
            'datajumlah' => [10, 15, 20],
        ];

        return json_encode($chartData);
    }

    public function ChartBarang()
    {
        // Implement your logic to retrieve Barang chart data
        // Example:
        $chartData = [
            'bulan' => ['January', 'February', 'March'],
            'barang' => ['Item A', 'Item B', 'Item C'],
            'jumlah' => [5, 10, 15],
        ];

        return json_encode($chartData);
    }

    public function PieChart()
    {
        // Implement your logic to retrieve Pie chart data
        // Example:
        $chartData = [
            'Pagi' => 30,
            'Malam' => 20,
        ];

        return json_encode($chartData);
    }


}
