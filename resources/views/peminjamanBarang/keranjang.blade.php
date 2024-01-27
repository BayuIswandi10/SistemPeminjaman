<!DOCTYPE html>
<html lang="en">
<head>
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/styles.css') }}" rel="stylesheet" />
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Course Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add other meta tags and stylesheets as needed -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/bootstrap4/bootstrap.min.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/ruangan1.css') }}">

    <!-- RRQ -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
    <link href="{{ asset('assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/adminlte3.2/dist/img/favicon.png') }}">

    <style type="text/css">
        .left{
           text-align: left;
         }
         .swal-footer {
           text-align: center;
           padding-top: 13px;
           margin-top: 13px;
           padding: 13px 16px;
           border-radius: inherit;
           border-top-left-radius: 0;
           border-top-right-radius: 0;
       }
         .button-pesan{
                     appearance: button;
                     background-color: #17a2b8;
                     background-image: none;
                     border: 1px solid #0059ab;
                     color: #000;
                     cursor: pointer;
                     display: inline-block;
                     font-family: ITCAvantGardeStd-Bk,Arial,sans-serif;
                     font-size: 14px;
                     font-weight: 400;
                     line-height: 20px;
                     /*margin: 100% 0px 0px -40px;*/
                     margin-left: -15%;
                     overflow: visible;
                     padding: 12px 40px;
                     text-align: center;
                     text-transform: none;
                     touch-action: manipulation;
                     user-select: none;
                     -webkit-user-select: none;
                     vertical-align: middle;
                     white-space: nowrap;
                 }
                 .button-pesan:hover {
                   appearance: button;
                     background-color: #17a2b8;
                     background-image: none;
                     border: 1px solid #0059ab;
                     box-sizing: border-box;
                     color: #000;
                     cursor: pointer;
                     display: inline-block;
                     font-family: ITCAvantGardeStd-Bk,Arial,sans-serif;
                     font-size: 14px;
                     font-weight: 400;
                     line-height: 20px;
                     overflow: visible;
                     /*padding: 12px 40px;*/
                     text-align: center;
                     text-transform: none;
                     touch-action: manipulation;
                     user-select: none;
                     -webkit-user-select: none;
                     vertical-align: middle;
                     white-space: nowrap;
                 }
     </style>

</head>
<body>

<div class="super_container">
    <!-- Header -->
    <header class="header d-flex flex-row" style="top: 10px; height: 70px;">
        @include('navbarMenu')
    </header>

    <!-- Home -->
    <div class="row" style="margin-top: 100px; width: 100%; height:100%; background-color: #0059ab; margin-left: 0px; margin-right: 0px;">
        <center><h1 style="margin-top: 50px; color: white">FORM KERANJANG </h1></center>
            <center>
                <form enctype="multipart/form-data" action="{{ route('pesanan_barang.mahasiswa') }}"  style="margin-top: 20px; align-items: left;">
                    <br><br><br>
                    <table class="table" id="example" style="background-color: #ffffff;width: 50%;">
                        <thead class="thead-light">
                            <tr>
                                <th><center></center></th>
                                <th><center>No</center></th>
                                <th><center>Nama Barang</center></th>
                                <th><center>Gambar Barang</center></th>
                                <th>Jumlah Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $count = 0;
                            @endphp
                            @foreach($keranjang as $data)
                            <tr>
                                <td><center><button class="btn btn-danger" onclick="del({{ $data->id }})"><i class="fa fa-trash" style="font-size: 15px;"></i></button></center></td>
                                <td><center>{{ $loop->iteration }}</center></td>
                                <td>{{ $data->barang->nama_barang }}</td>
                                <td><center><img id="img{{ $loop->iteration }}" onclick="zoom('img{{ $loop->iteration }}')" width="100px" src="{{ asset($data->barang->gambar_barang) }}"></center></td>
                                <td><center>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary rounded-circle" onclick="minus({{ $data->id }});" type="button"><i class="fa fa-minus" style="font-size: 15px;"></i></button>
                                    </div>
                                    <span id="Jumlah{{ $data->id }}" class="ml-3 mr-3 mt-2">{{ $data->jumlah }}</span>
                                    <span hidden id="idBarang{{ $data->id }}" class="ml-3 mr-3 mt-2">{{ $data->id_barang }}</span>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary rounded-circle" onclick="plus({{ $data->id }});" type="button"><i class="fa fa-plus" style="font-size: 15px;"></i></button>
                                    </div>
                                </div>
                                </center></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-4 row" style="margin-top: 30px;margin-bottom: 30px;">
                        <div class="col-md-6">
                            <input type="submit" name="submit" value="PESAN" class="button-pesan">
                        </div>
                        <div class="col-md-6">
                            <a name="kembali" onclick="window.history.go(-1);" class="button-pesan" style="background-color: #fff;color: black">KEMBALI</a>
                        </div>
                    </div>
                </form>
            </center>
    </div>
    

    <footer class="footer" style="padding-top: 0px;margin-top: 0px;">
        <div class="container">
            <div class="footer_bar d-flex flex-column flex-sm-row align-items-center">
                <div class="footer_copyright">
                    <span>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | Polteknik Astra</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </span>
                </div>
            </div>

        </div>
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

    function validateImage(input, previewId) {
        var allowedFormats = ['image/png', 'image/jpg', 'image/jpeg'];
        var file = input.files[0];

        if (file) {
            if (allowedFormats.includes(file.type)) {
                var preview = document.getElementById(previewId);
                var reader = new FileReader();

                reader.onloadend = function () {
                    preview.src = reader.result;
                }

                reader.readAsDataURL(file);
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Format file tidak valid. Pilih file dengan format PNG, JPG, atau JPEG.',
                    icon: 'error'
                });
                input.value = ''; // Clear the input to prevent submission of invalid file
                document.getElementById(previewId).src = ''; // Clear the preview image
            }
        }
    }


    // Display validation errors in Swal
    @if ($errors->any())
    Swal.fire({
        icon: 'error',
        title: 'Whoops!',
        html: '<ul>' +
            @foreach ($errors->all() as $error)
                '<li>{{ $error }}</li>' +
            @endforeach
            '</ul>'
    });
    @endif

    // Display success message in Swal
    @if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}'
    });
    @endif

    // Display error message in Swal
    @if (session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}'
    });
    @endif

</script>

<script>
    function plus(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('plus') }}",
            data: {
                id: id,
                jumlah: parseInt($('#Jumlah' + id).text()) + 1
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                if (response.success) {
                    $('#Jumlah' + id).text(response.message);
                } else {
                    alert(response.message); // Tampilkan pesan jika stok tidak mencukupi
                }
            }
        });
    }

    function minus(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('minus') }}",
            data: {
                id: id,
                jumlah: parseInt($('#Jumlah' + id).text()) - 1
            },
            success: function(response) {
                if (response.success) {
                    $('#Jumlah' + id).text(response.message);
                }
            }
        });
    }

    function del(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('del') }}",
            data: {
                id: id
            },
            success: function(response) {
                if (response.success) {
                    window.location.reload();
                }
            }
        });
    }
</script>

<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('assets/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('assets/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/scrollTo/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('assets/plugins/easing/easing.js') }}"></script>
</body>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('assets/dist/js/scripts.js') }}"></script>
</body>
</html>
