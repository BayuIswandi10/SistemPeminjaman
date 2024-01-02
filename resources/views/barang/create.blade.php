@extends('layouts.app')

@section('title','Menu Barang')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Menu</a></li>
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item">Barang</li>
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
                        <form  method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Data Barang</h4>
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
                                <label for="barang_id">ID <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="barang_id" value="{{ old('barang_id') }}" placeholder="Masukan ID Anda">
                            </div>
                            <div class="form-group">
                                <label for="nama_barang">Nama <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Masukan Nama Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="nomor_aktiva">Nomor Aktiva <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="nomor_aktiva" value="{{ old('nomor_aktiva') }}" placeholder="Masukan Nomor Aktiva Anda" required>
                            </div>
                            <div class="form-group">
                                <label>Tipe Barang <span style="color:red;">*</span></label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipe_barang" id="{{ old('tipe_barang') }}" value="Konsumable" required>
                                    <label class="form-check-label" for="tipe_barang">
                                        Konsumabel
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipe_barang" id="{{ old('tipe_barang') }}" value="Unkonsumabel" required>
                                    <label class="form-check-label" for="tipe_barang">
                                        Unkonsumabel
                                    </label>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label for="stok">Jumlah <span  style="color:red;">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="stok" value="{{ old('stok') }}" placeholder="Masukkan Nomor Telepon Barang" minlength="11" maxlength="13" required/>
                                    <br>
                                    <div class="input-group-append">
                                      <select name="satuan_barang" value="{{ old('satuan_barang') }}" class="form-control" required>
                                        <option selected value="" disabled>-- Pilih Satuan --</option>
                                        <option value="Pcs">Pcs</option>
                                        <option value="Lembar">Lembar</option>
                                        <option value="Pack">Pack</option>
                                      </select>
                                    </div>
                                  </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan_barang">Kondisi Barang <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('keterangan_barang') }}" name="keterangan_barang" placeholder="Masukkan Kondisi Barang" required/>
                            </div>
                            <div class="form-group">
                                <label for="lokasi_barang">Lokasi Barang <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('lokasi_barang') }}" name="lokasi_barang" placeholder="Masukkan Lokasi Barang" required/>
                            </div>
                            <div class="form-group">
                                <label for="baris_lokasi">Baris Lokasi <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('baris_lokasi') }}" name="baris_lokasi" placeholder="Masukkan Baris Lokasi Barang" required/>
                            </div>
                            <div class="form-group">
                                <label for="gambar_barang" id="gambar_barang">Foto Barang <span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                <input type="file" id="gambar_barang" name="gambar_barang" class="custom-file-input" required />
                                <label class="custom-file-label" for="gambar_barang">Pilih file</label>
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