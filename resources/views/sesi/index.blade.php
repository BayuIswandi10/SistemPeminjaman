@extends('layouts.app')

@section('title','Menu Sesi')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Sesi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item">Data</li>
                <li class="breadcrumb-item">Sesi</li>
            </ol>
            </div>
        </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- TABLE -->
                <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            @if(session()->has('logged_in') && session('logged_in')->role === 'Super Admin')                                       
                            <button class="btn btn-primary btn-md float-right">
                                <a href="{{ route('sesi.create') }}" class="text-white">
                                    <i class="fa fa-plus mr-1"></i> Tambah Data
                                </a>
                            </button>
                            @endif
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: '{{ session('success') }}',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                </script>
                            @endif

                            @if (session('error'))
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: '{{ session('error') }}',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                </script>
                            @endif

                            <table id="dataTable" class="display nowrap table-striped table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>nama_sesi</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Status</th>
                                        @if(session()->has('logged_in') && session('logged_in')->role === 'Super Admin')                                       
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($sesi as $data)
                                        <tr >
                                            <td >{{ ++$i }}</td>
                                            <td>{{ $data->nama_sesi }}</td>
                                            <td>{{ $data->sesi_awal }}</td>
                                            <td>{{ $data->sesi_akhir }}</td>
                                            <td>
                                                @if($data->status == "Pengajuan")
                                                <span class="badge badge-warning" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == "Dipinjam")
                                                    <span class="badge badge-info" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == "Selesai")
                                                    <span class="badge badge-primary" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == "Tidak Aktif")
                                                    <span class="badge badge-danger" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == "Aktif")
                                                    <span class="badge badge-success" style="font-size:15px;">{{ $data->status }}</span>
                                                @endif  
                                            </td>
                                            @if(session()->has('logged_in') && session('logged_in')->role === 'Super Admin')                                       
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('sesi.edit', ['id' => $data->sesi_id]) }}" class="btn btn-primary color-muted editbtn">
                                                        <i class="fa fa-pencil-square-o color-muted editbtn"></i>
                                                    </a>
                                                    <form id="deleteForm_{{ $data->sesi_id }}" action="{{ route('sesi.destroy', ['id' => $data->sesi_id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $data->sesi_id }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>                                                 
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- END TABLE -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            columnDefs: [
                {className: 'dt-body-center',targets: 0},
                {className: 'dt-head-center',targets: 0},
                {className: 'dt-body-center',targets: 4},
                {className: 'dt-head-center',targets: 4},
            ],
            scrollX: true,
            responsive: true
        });
    });

    function confirmDelete(sesiId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this data!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Delete form submission
                document.getElementById('deleteForm_' + sesiId).submit();
            }
        });
    }
</script>
@endsection