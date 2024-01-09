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
                        <form  method="POST"  action="{{ route('ruangan.update', $ruangan->ruangan_id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Ubah Data Ruangan</h4>
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
                                    <label for="nama_ruangan">Nama Ruangan<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="nama_ruangan" value="{{ ($ruangan->nama_ruangan) }}" placeholder="Masukan Nama Ruangan Anda" required>
                                </div>
                                <div class="form-group">
                                    <label for="lokasi_ruangan">Lokasi Ruangan <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="lokasi_ruangan" value="{{ ($ruangan->lokasi_ruangan) }}" placeholder="Masukan Lokasi Ruangan Anda" required>
                                </div>
                                <div class="form-group">
                                    <label for="kapasitas_ruangan">Kapasitas <span  style="color:red;">*</span></label>
                                    <input type="number" class="form-control" name="kapasitas_ruangan" value="{{ ($ruangan->kapasitas_ruangan) }}" placeholder="Masukkan Kapasitas ruangan" required/>
                                </div>
                                <div class="form-group">
                                    <label for="nama_fasilitas">Nama Fasilitas <span style="color:red;">*</span></label>
                                    <button onclick="tambahComboBox()">Tambah Combo Box</button>
                                    <div id="container" style="display: flex; flex-direction: column;">
                                        <div class="combo-box" style="display: flex; align-items: center;">
                                            <select class="form-control" name="fasilitas_ids[]" onchange="validateComboBox(this)" required>
                                                <option selected value="" disabled>-- Pilih Fasilitas --</option>
                                                @foreach ($fasilitas as $fasilitasId => $fasilitasName)
                                                    <option value="{{ $fasilitasId }}" @selected(old('fasilitas_ids[]') == $fasilitasId)>
                                                        {{ $fasilitasName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="number" name="jumlah[]" class="jumlah-input" placeholder="Jumlah">
                                            <button onclick="hapusComboBox(this)">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="koor_upt">Koor UPT <span style="color:red;">*</span></label><br>
                                    <select class="form-control"  name="koor_upt" aria-label="Default select example" required>
                                    <option selected value="" disabled>-- Pilih Role --</option>
                                    <option value="Sisia Dika Ariyanto" {{ $ruangan->koor_upt == 'Sisia Dika Ariyanto' ? 'selected' : '' }}>Sisia Dika Ariyanto</option>
                                    <option value="Candra Bagus Kristanto" {{ $ruangan->koor_upt == 'Candra Bagus Kristanto' ? 'selected' : '' }}>Candra Bagus Kristanto</option>
                                    <option value="Kristina Hutajulu" {{ $ruangan->koor_upt == 'Kristina Hutajulu' ? 'selected' : '' }}>Kristina Hutajulu</option>
                                    <option value="Eko Abdul Goffar" {{ $ruangan->koor_upt == 'Eko Abdul Goffar' ? 'selected' : '' }}>Eko Abdul Goffar</option> 
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pic_lab">PIC Lab <span style="color:red;">*</span></label><br>
                                    <select class="form-control"  name="pic_lab" aria-label="Default select example" required>
                                    <option selected value="" disabled>-- Pilih Role --</option>
                                    <option value="Sisia Dika Ariyanto" {{ $ruangan->pic_lab == 'Sisia Dika Ariyanto' ? 'selected' : '' }}>Sisia Dika Ariyanto</option>
                                    <option value="Candra Bagus Kristanto" {{ $ruangan->pic_lab == 'Candra Bagus Kristanto' ? 'selected' : '' }}>Candra Bagus Kristanto</option>
                                    <option value="Kristina Hutajulu" {{ $ruangan->pic_lab == 'Kristina Hutajulu' ? 'selected' : '' }}>Kristina Hutajulu</option>
                                    <option value="Eko Abdul Goffar" {{ $ruangan->pic_lab == 'Eko Abdul Goffar' ? 'selected' : '' }}>Eko Abdul Goffar</option> 
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="admin_lab1">Admin Lab 1 <span style="color:red;">*</span></label><br>
                                    <select class="form-control" name="admin_lab1" aria-label="Default select example" required>
                                    <option selected value="" disabled>-- Pilih Role --</option>
                                    <option value="Sisia Dika Ariyanto" {{ $ruangan->admin_lab1 == 'Sisia Dika Ariyanto' ? 'selected' : '' }}>Sisia Dika Ariyanto</option>
                                    <option value="Candra Bagus Kristanto" {{ $ruangan->admin_lab1 == 'Candra Bagus Kristanto' ? 'selected' : '' }}>Candra Bagus Kristanto</option>
                                    <option value="Kristina Hutajulu" {{ $ruangan->admin_lab1 == 'Kristina Hutajulu' ? 'selected' : '' }}>Kristina Hutajulu</option>
                                    <option value="Eko Abdul Goffar" {{ $ruangan->admin_lab1 == 'Eko Abdul Goffar' ? 'selected' : '' }}>Eko Abdul Goffar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="admin_lab2">Admin Lab 2 <span style="color:red;">*</span></label><br>
                                    <select class="form-control" name="admin_lab2" aria-label="Default select example" required>
                                    <option selected value="" disabled>-- Pilih Role --</option>
                                    <option value="Sisia Dika Ariyanto" {{ $ruangan->admin_lab2 == 'Sisia Dika Ariyanto' ? 'selected' : '' }}>Sisia Dika Ariyanto</option>
                                    <option value="Candra Bagus Kristanto" {{ $ruangan->admin_lab2 == 'Candra Bagus Kristanto' ? 'selected' : '' }}>Candra Bagus Kristanto</option>
                                    <option value="Kristina Hutajulu" {{ $ruangan->admin_lab2 == 'Kristina Hutajulu' ? 'selected' : '' }}>Kristina Hutajulu</option>
                                    <option value="Eko Abdul Goffar" {{ $ruangan->admin_lab2 == 'Eko Abdul Goffar' ? 'selected' : '' }}>Eko Abdul Goffar</option>
                                    </select>
                                </div>                           
                                <div class="form-group" hidden>
                                    <label for="keterangan_ruangan">Keterangan ruangan <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" value="Baik" id="keterangan_ruangan" name="keterangan_ruangan" placeholder="Masukkan Kondisi ruangan" required/>
                                </div>
                                <div class="form-group" hidden>
                                    <label for="created_date">Created Date <span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" name="created_date" value="{{ old('created_date') ? old('created_date') : now()->format('Y-m-d') }}" required />
                                </div>
                                <div class="form-group" hidden >
                                    <label for="status">Status <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="status" value="Aktif" id="status">
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