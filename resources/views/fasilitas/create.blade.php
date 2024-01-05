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
                    <li class="breadcrumb-item">Create</li>

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
                        <form  method="POST" action="{{ route('fasilitas.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Data Fasilitas</h4>
                            </div>
                            <div class="modal-body">
                                    <!-- Tampilkan pesan error jika ada -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                            <div class="form-group" hidden>
                                <label for="fasilitas_id">ID <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="fasilitas_id" value="{{ old('fasilitas_id') }}" placeholder="Masukan ID Anda">
                            </div>
                            <div class="form-group">
                                <label for="nama_fasilitas">Nama <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="nama_fasilitas" value="{{ old('nama_fasilitas') }}" placeholder="Masukan Nama Fasilitas Anda" required>
                            </div>
                            
                            <div class="form-group" hidden>
                                <label for="created_date">Created Date <span style="color:red;">*</span></label>
                                <input type="date" class="form-control" name="created_date" value="{{ old('created_date') ? old('created_date') : now()->format('Y-m-d') }}" required />
                            </div>
                            <div class="form-group">
                                <label for="foto_fasilitas" id="foto_fasilitas">Foto Fasilitas <span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                <input type="file" id="foto_fasilitas" name="foto_fasilitas" class="custom-file-input" required />
                                <label class="custom-file-label" for="foto_fasilitas">Pilih file</label>
                                </div>
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
                </div> 
            </div> 
        </div> 
    </section>
</div>   

@endsection