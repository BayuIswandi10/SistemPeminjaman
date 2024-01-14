@extends('layouts.template_login')

@section('contents')

<head>
    <style>
        /* Center the form vertically and horizontally */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Full viewport height */
            margin: 0;
        }

        /* Adjust the form width */
        .login-box {
            width: 400px; /* Set the desired width */
        }

        .nav-static-top {
            top: 0; 
            left: 0;
            right: 0;
            position: fixed;
            height: 70px;
            width: 100% !important;
            box-shadow: 0px 2px 0px 0px #eee;
            background-color: white;
            z-index: 4;
            opacity: 0.9;
        }
    </style>
</head>

<body class="hold-transition login-page" style="background-image: url('{{ asset('assets/adminlte3.2/dist/img/IMG_Background.jpg') }}'); background-repeat: no-repeat; background-size: cover;">
    <div class="nav-static-top">
        <div class="float-left">
            <a href="#">
                <img class="mt-3 ml-4" src="{{ asset('assets/foto/logo.png') }}" style="height:40px;">
            </a>
        </div>
    </div>

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="text-center">
                    <b class="h2">Peminjaman Ruangan dan Barang</b>

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                </div>
                <hr>
                <h4 class="login-box-msg">Masuk Mahasiswa</h4>
                <form action="{{ route('logins.loginAksiMahasiswa') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Username <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" >
                    </div>

                    <div class="form-group">
                        <label>Kata Sandi <span style="color:red;">*</span></label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    
                    <div class="form-group">
                        <p>Masuk Sebagai Admin ?<a href="{{ route('logins.index') }}" style="color: #1767b1"> Klik Disini</a></p>
                    </div>

                    <div class="text-center">                    
                        <a href="{{ route('dashboard') }}" class="btn btn-danger ">Kembali</a>
                        <button type="submit" class="btn btn-primary">Masuk</button>                
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


@if (Session::has('error'))
<script>
    console.log('Error');
    Swal.fire({
        title: 'Pesan',
        text: '{{ Session::get('error') }}',
        icon: 'error'
    });
</script>
@endif

@if (Session::has('successLogout'))
<script>
    console.log('success');
    Swal.fire({
        title: 'Pesan',
        text: '{{ Session::get('successLogout') }}',
        icon: 'success'
    });
</script>
@endif

@endsection