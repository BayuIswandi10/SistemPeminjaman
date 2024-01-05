@extends('layouts.app')

@section('title','Menu Pengguna')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Menu</a></li>
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item">Edit</li>

                </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <form  method="POST"  action="{{ route('pengguna.update', $pengguna->pengguna_id) }}" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" name="nama" value="{{ $pengguna->nama }}" placeholder="Masukan Nama Anda">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="alamat" value="{{ $pengguna->alamat }}" placeholder="Masukan Alamat Anda">
                                </div>
                                <div class="form-group">
                                    <label for="nohp">Nomor Telepon <span  style="color:red;">*</span></label>
                                    <input type="number" class="form-control" name="nohp" value="{{ $pengguna->nohp }}" placeholder="Masukkan Nomor Telepon Admin" minlength="11" maxlength="13" />
                                </div>
                                <div class="form-group">
                                    <label for="other_job">Other Job <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" value="{{ $pengguna->other_job }}" name="other_job" placeholder="Masukkan Pekerjaan Lain" />
                                </div>
                                <div class="form-group">
                                    <label for="main_job">Role <span style="color:red;">*</span></label><br>
                                    <select class="form-control" name="main_job" aria-label="Default select example" required>
                                        <option disabled>-- Pilih Role --</option>
                                        <option value="Super Admin" {{ $pengguna->main_job == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                        <option value="Koor UPT" {{ $pengguna->main_job == 'Koor UPT' ? 'selected' : '' }}>Koor UPT</option>
                                        <option value="PIC Lab" {{ $pengguna->main_job == 'PIC Lab' ? 'selected' : '' }}>PIC Lab</option>
                                        <option value="Admin Lab 1" {{ $pengguna->main_job == 'Admin Lab 1' ? 'selected' : '' }}>Admin Lab 1</option>
                                        <option value="Admin Lab 2" {{ $pengguna->main_job == 'Admin Lab 2' ? 'selected' : '' }}>Admin Lab 2</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="foto" id="lblfoto">Foto Admin <span class="form-group-text" style="color:red;">*</span></label><br>
                                    <div class="custom-file">
                                        <input type="hidden" class="form-control" id="foto" name="foto" />
                                        <input type="file" id="foto" name="foto" class="custom-file-input" aria-describedby="lblfoto" />
                                    <label class="custom-file-label" for="foto">Pilih file</label>
                                    <img src="{{ asset($pengguna->foto) }}" class="img-thumbnail" style="width:200px" />
                                </div>
                                <div class="form-group" hidden>
                                    <label for="status">Status <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" value="{{ $pengguna->status }}" name="status" placeholder="Masukkan Pekerjaan Lain" />
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
                </div> 
            </div> 
        </div> 
    </section>
</div>   

@endsection