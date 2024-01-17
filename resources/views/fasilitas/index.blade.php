@extends('layouts.app')

@section('title','Menu Fasilitas')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Fasilitas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item">Data</li>
                <li class="breadcrumb-item">Fasilitas</li>
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
                            @if(session()->has('logged_in') && session('logged_in')->role === 'Admin')                                       
                            <button class="btn btn-primary btn-md float-right">
                                <a href="{{ route('fasilitas.create') }}" class="text-white">
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
                                        <th>Nama</th>
                                        <th>Foto</th>
                                        @if(session()->has('logged_in') && session('logged_in')->role === 'Admin')                                       
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($fasilitas as $data)
                                        <tr >
                                            <td >{{ ++$i }}</td>
                                            <td>{{ $data->nama_fasilitas }}</td>
                                            <td>
                                                @if ($data->foto_fasilitas)
                                                    <img src="{{ asset($data->foto_fasilitas) }}" alt="{{ $data->nama_fasilitas }}" style="max-width: 100px; max-height: 100px;">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            @if(session()->has('logged_in') && session('logged_in')->role === 'Admin')                                       
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('fasilitas.edit', ['id' => $data->fasilitas_id]) }}" class="btn btn-primary color-muted editbtn">
                                                        <i class="fa fa-pencil-square-o color-muted editbtn"></i>
                                                    </a>
                                                    <form id="deleteForm_{{ $data->fasilitas_id }}" action="{{ route('fasilitas.destroy', ['id' => $data->fasilitas_id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $data->fasilitas_id }}')">
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

                <!-- MODAL -->
                <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- tambahData Modal -->
       {{--      <div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="tambahData" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                        <form  method="POST" action="{{ route('fasilitas.store') }}" enctype="multipart/form-data">
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
                                <label for="fasilitas_id">ID <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="fasilitas_id" value="{{ old('fasilitas_id') }}" placeholder="Masukan ID Anda">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Masukan Nama Anda">
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
                        <form  method="POST"  action="{{ route('fasilitas.update', $data->fasilitas_id) }}" enctype="multipart/form-data">
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
                                    <label for="nama">Nama <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" placeholder="Masukan Nama Anda">
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
                {className: 'dt-body-center',targets: 3},
                {className: 'dt-head-center',targets: 3},
            ],
            scrollX: true,
            responsive: true
        });
    });

    function confirmDelete(fasilitasId) {
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
                document.getElementById('deleteForm_' + fasilitasId).submit();
            }
        });
    }
</script>
@endsection