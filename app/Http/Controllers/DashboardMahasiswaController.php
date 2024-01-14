<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardMahasiswaController extends Controller
{
    public function indexMahasiswa()
    {
        return view('Dashboard.dashboardMahasiswa');
    }
}
