@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Beranda</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('Functions/Dashboard') }}">Menu</a></li>
                        <li class="breadcrumb-item">Beranda</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Small boxes -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>Pengajuan Peminjaman Barang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ asset('#') }}" class="small-box-footer">Informasi Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ... (other small boxes) ... -->
            </div>
            <!-- Other rows -->
            <div class="row">
                <!-- Additional boxes -->
                <div class="col-lg-3 col-6">
                    <!-- Table for frequently borrowed rooms -->
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>Ruangan</h3>
                            <table class="table">
                                <!-- Adjust table content based on frequently borrowed rooms -->
                                <!-- ... (Frequently borrowed rooms table content) ... -->
                            </table>
                        </div>
                        <a href="{{ asset('#') }}" class="small-box-footer">Informasi Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- Table for frequently borrowed items -->
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>Barang</h3>
                            <table class="table">
                                <!-- Adjust table content based on frequently borrowed items -->
                                <!-- ... (Frequently borrowed items table content) ... -->
                            </table>
                        </div>
                        <a href="{{ asset('#') }}" class="small-box-footer">Informasi Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Additional rows -->
            <div class="row">
                <!-- Additional elements -->
                <div class="col-lg-3 col-6">
                    <!-- Time of borrowings -->
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>Waktu Peminjaman</h3>
                            <p>11:00 AM - 1:00 PM</p>
                        </div>
                        <a href="{{ asset('#') }}" class="small-box-footer">Informasi Selanjutnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        //--------------
        //- BAR CHART RUANGAN -
        //--------------

        // ... your existing JavaScript code ...
        // ...

        //--------------
        //- BAR CHART BARANG -
        //--------------

        // ... your existing JavaScript code ...
        // ...

        //-------------
        //- PIE CHART -
        //-------------

        // ... your existing JavaScript code ...
        // ...
    });
</script>
@endsection
