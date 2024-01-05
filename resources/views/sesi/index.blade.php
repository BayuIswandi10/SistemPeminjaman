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
                            <button class="btn btn-primary btn-md float-right">
                                <a href="{{ route('sesi.create') }}" class="text-white">
                                    <i class="fa fa-plus mr-1"></i> Tambah Data
                                </a>
                            </button>
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
                                        <th>ID</th>
                                        <th>nama_sesi</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($sesi as $data)
                                        <tr >
                                            <td >{{ ++$i }}</td>
                                            <td>{{ $data->sesi_id }}</td>
                                            <td>
                                                @if($data->status == "Pengajuan")
                                                <span class="badge badge-warning" style="font-size:15px;">{{ $data->nama_sesi }}</span>
                                                @elseif ($data->status == "Dipinjam")
                                                    <span class="badge badge-info" style="font-size:15px;">{{ $data->nama_sesi }}</span>
                                                @elseif ($data->status == "Selesai")
                                                    <span class="badge badge-primary" style="font-size:15px;">{{ $data->nama_sesi }}</span>
                                                @elseif ($data->status == "Tidak Aktif")
                                                    <span class="badge badge-danger" style="font-size:15px;">{{ $data->nama_sesi }}</span>
                                                @elseif ($data->status == "Aktif")
                                                    <span class="badge badge-success" style="font-size:15px;">{{ $data->nama_sesi }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $data->sesi_awal }}</td>
                                            <td>{{ $data->sesi_akhir }}</td>
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

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- END TABLE -->

                <!-- MODAL -->
                <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- tambahData Modal -->
       {{--      <div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="tambahData" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                        <form  method="POST" action="{{ route('sesi.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Tambah Data Admin</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <div class="alert-title"><h4>Whoops!</h4></div>
                                    There are some problems with your input.
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                            </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <div class="form-group">
                                <label for="username">Username <span style="color:red;">*</span></label>
                                <input type="text" autocomplete="FALSE" required class="form-control" value="{{ old('username') }}" name="username" placeholder="Masukkan Username" />
                            </div>
                            <div class="form-group">
                                <label for="password">Kata Sandi <span style="color:red;">*</span></label>
                                <div class="input-group" id="show_hide_password">
                                <input type="password" required class="form-control" value="{{ old('password') }}" name="password" placeholder="Masukkan Password" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-eye-slash" aria-hidden="true"></i></span>
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sesi_id">ID <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="sesi_id" value="{{ old('sesi_id') }}" placeholder="Masukan ID Anda">
                            </div>
                            <div class="form-group">
                                <label for="nama_sesi">nama_sesi <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="nama_sesi" value="{{ old('nama_sesi') }}" placeholder="Masukan nama_sesi Anda">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" placeholder="Masukan Alamat Anda">
                            </div>
                            <div class="form-group">
                                <label for="nohp">Nomor Telepon <span  style="color:red;">*</span></label>
                                <input type="number" class="form-control" name="nohp" value="{{ old('nohp') }}" placeholder="Masukkan Nomor Telepon Admin" minlength="11" maxlength="13" />
                            </div>
                            <div class="form-group">
                                <label for="other_job">Other Job <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('other_job') }}" name="other_job" placeholder="Masukkan Pekerjaan Lain" />
                            </div>
                            <div class="form-group">
                                <label for="main_job">Role <span style="color:red;">*</span></label><br>
                                <select class="form-control" value="{{ old('main_job') }}" name="main_job" aria-label="Default select example" required>
                                <option selected value="" disabled>-- Pilih Role --</option>
                                <option value="Super Admin">Super Admin</option>
                                <option value="Koor UPT">Koor UPT</option>
                                <option value="PIC Lab">PIC Lab</option>
                                <option value="Admin Lab 1">Admin Lab 1</option>
                                <option value="Admin Lab 2">Admin Lab 2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="foto" id="foto">Foto PIC <span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                <input type="file" id="foto" name="foto" class="custom-file-input" required />
                                <label class="custom-file-label" for="foto">Pilih file</label>
                                </div>
                            </div>
                            <div class="form-group" hidden >
                                <label for="status">Status <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="status" value="Aktif" id="status">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" Text="Create" class="btn btn-primary shadow-sm" >Tambah</button>
                            </div>
                            </div>
                        </div>
                        </form>
                        <!-- /.modal-content -->
                    </div>
                </div> --}}
                <!-- /.tambahData Modal -->

                <!-- editData Modal -->
           {{--     <div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="tambahData" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                        <form  method="POST"  action="{{ route('sesi.update', $data->sesi_id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Ubah Data Admin</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <div class="alert-title"><h4>Whoops!</h4></div>
                                        There are some problems with your input.
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="nama_sesi">nama_sesi <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="nama_sesi" value="{{ $data->nama_sesi }}" placeholder="Masukan nama_sesi Anda">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="alamat" value="{{ $data->alamat }}" placeholder="Masukan Alamat Anda">
                                </div>
                                <div class="form-group">
                                    <label for="nohp">Nomor Telepon <span  style="color:red;">*</span></label>
                                    <input type="number" class="form-control" name="nohp" value="{{ $data->nohp }}" placeholder="Masukkan Nomor Telepon Admin" minlength="11" maxlength="13" />
                                </div>
                                <div class="form-group">
                                    <label for="other_job">Other Job <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" value="{{ $data->other_job }}" name="other_job" placeholder="Masukkan Pekerjaan Lain" />
                                </div>
                                <div class="form-group">
                                    <label for="main_job">Role <span style="color:red;">*</span></label><br>
                                    <select class="form-control" value="{{ $data->main_job }}" name="main_job" aria-label="Default select example" required>
                                    <option selected value="" disabled>-- Pilih Role --</option>
                                    <option value="Super Admin">Super Admin</option>
                                    <option value="Koor UPT">Koor UPT</option>
                                    <option value="PIC Lab">PIC Lab</option>
                                    <option value="Admin Lab 1">Admin Lab 1</option>
                                    <option value="Admin Lab 2">Admin Lab 2</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="foto" id="lblfoto">Foto Admin <span class="form-group-text" style="color:red;">*</span></label><br>
                                    <div class="custom-file">
                                        <input type="hidden" class="form-control" id="foto" name="foto" />
                                        <input type="file" id="foto" name="foto" class="custom-file-input" aria-describedby="lblfoto" />
                                    <label class="custom-file-label" for="foto">Pilih file</label>
                                    <img src="{{ asset('storage/' . $data->foto) }}" class="img-thumbnail" style="width:200px" />
                                </div>
                                <div class="form-group" hidden>
                                    <label for="status">Status <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" value="{{ $data->status }}" name="status" placeholder="Masukkan Pekerjaan Lain" />
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" Text="Edit" class="btn btn-primary shadow-sm">Ubah</button>
                            </div>
                        </div>
                        </form>
                        <!-- /.modal-content -->
                    </div>
                </div> --}}
                <!-- /.editData Modal -->
                <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- END MODAL -->
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
                {className: 'dt-body-center',targets: 5},
                {className: 'dt-head-center',targets: 5},
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