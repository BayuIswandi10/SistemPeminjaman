@extends('layouts.app')

@section('title','Menu Ruangan')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Ruangan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Menu</a></li>
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item">Ruangan</li>
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
                        <form  method="POST" action="{{ route('ruangan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Data ruangan</h4>
                            </div>
                            <div class="modal-body">
                            @if(session('error'))
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: '{{ session('error') }}'
                                    });
                                </script>
                            @endif

                            <div class="form-group" hidden>
                                <label for="ruangan_id">ID <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="ruangan_id" value="{{ old('ruangan_id') }}" placeholder="Masukan ID Anda">
                            </div>
                            <div class="form-group">
                                <label for="nama_ruangan">Nama Ruangan<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="nama_ruangan" value="{{ old('nama_ruangan') }}" placeholder="Masukan Nama Ruangan Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="lokasi_ruangan">Lokasi Ruangan <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="lokasi_ruangan" value="{{ old('lokasi_ruangan') }}" placeholder="Masukan Lokasi Ruangan Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="kapasitas_ruangan">Kapasitas <span  style="color:red;">*</span></label>
                                <input type="number" class="form-control" name="kapasitas_ruangan" value="{{ old('kapasitas_ruangan') }}" placeholder="Masukkan Kapasitas ruangan" required/>
                            </div>
                            <div class="form-group">
                                <label for="koor_upt">Fasilitas <span style="color:red;">*</span></label><br>
                                @foreach ($fasilitas as $fasilitasid => $fasilitasname)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fasilitas_ids[]" value="{{ $fasilitasid }}">
                                        <label class="form-check-label">
                                            {{ $fasilitasname }}
                                        </label>
                                    </div>
                                @endforeach    
                            </div>
                            <div class="form-group">
                                <label for="koor_upt">Koor UPT <span style="color:red;">*</span></label><br>
                                <select class="form-control" value="{{ old('koor_upt') }}" name="koor_upt" aria-label="Default select example" required>
                                <option selected value="" disabled>-- Pilih Role --</option>
                                <option value="Sisia Dika Ariyanto">Sisia Dika Ariyanto</option>
                                <option value="Candra Bagus Kristanto">Candra Bagus Kristanto</option>
                                <option value="Kristina Hutajulu">Kristina Hutajulu</option>
                                <option value="Eko Abdul Goffar">Eko Abdul Goffar</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pic_lab">PIC Lab <span style="color:red;">*</span></label><br>
                                <select class="form-control" value="{{ old('pic_lab') }}" name="pic_lab" aria-label="Default select example" required>
                                <option selected value="" disabled>-- Pilih Role --</option>
                                <option value="Sisia Dika Ariyanto">Sisia Dika Ariyanto</option>
                                <option value="Candra Bagus Kristanto">Candra Bagus Kristanto</option>
                                <option value="Kristina Hutajulu">Kristina Hutajulu</option>
                                <option value="Eko Abdul Goffar">Eko Abdul Goffar</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="admin_lab1">Admin Lab 1 <span style="color:red;">*</span></label><br>
                                <select class="form-control" value="{{ old('admin_lab1') }}" name="admin_lab1" aria-label="Default select example" required>
                                <option selected value="" disabled>-- Pilih Role --</option>
                                <option value="Sisia Dika Ariyanto">Sisia Dika Ariyanto</option>
                                <option value="Candra Bagus Kristanto">Candra Bagus Kristanto</option>
                                <option value="Kristina Hutajulu">Kristina Hutajulu</option>
                                <option value="Eko Abdul Goffar">Eko Abdul Goffar</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="admin_lab2">Admin Lab 2 <span style="color:red;">*</span></label><br>
                                <select class="form-control" value="{{ old('admin_lab2') }}" name="admin_lab2" aria-label="Default select example" required>
                                <option selected value="" disabled>-- Pilih Role --</option>
                                <option value="Sisia Dika Ariyanto">Sisia Dika Ariyanto</option>
                                <option value="Candra Bagus Kristanto">Candra Bagus Kristanto</option>
                                <option value="Kristina Hutajulu">Kristina Hutajulu</option>
                                <option value="Eko Abdul Goffar">Eko Abdul Goffar</option>
                                </select>
                            </div>                           
                            <div class="form-group" hidden>
                                <label for="keterangan_ruangan">Kondisi ruangan <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="Baik" id="keterangan_ruangan" name="keterangan_ruangan" placeholder="Masukkan Kondisi ruangan" required/>
                            </div>
                            <div class="form-group">
                                <label for="foto1" id="foto1">Foto ruangan 1<span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                <input type="file" id="foto1" name="foto1" class="custom-file-input" required />
                                <label class="custom-file-label" for="foto1">Pilih file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto2" id="foto2">Foto ruangan 2<span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                <input type="file" id="foto2" name="foto2" class="custom-file-input" required />
                                <label class="custom-file-label" for="foto2">Pilih file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto3" id="foto3">Foto ruangan 3<span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                <input type="file" id="foto3" name="foto3" class="custom-file-input" required />
                                <label class="custom-file-label" for="foto3">Pilih file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto4" id="foto4">Foto ruangan 4<span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                <input type="file" id="foto4" name="foto4" class="custom-file-input" required />
                                <label class="custom-file-label" for="foto4">Pilih file</label>
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <label for="created_date">Created Date <span style="color:red;">*</span></label>
                                <input type="date" class="form-control" name="created_date" value="{{ old('created_date') ? old('created_date') : now()->format('Y-m-d') }}" required />
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
                </div> 
            </div> 
        </div> 
    </section>
</div>   

@endsection