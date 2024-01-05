<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Course Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda</title>
    
    <!-- Include CSS files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dist/css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/bootstrap4/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">
</head>
<body>

    <div class="super_container">
        <header class="header d-flex flex-row" style="top: 10px; height: 70px;">
            <div class="header_content d-flex flex-row align-items-center" style="width: 100%;">
                <img src="{{ asset('assets/foto/logo.png') }}" alt="" style="width: 25%; padding-left: 2%;">
        
                <!-- Main Navigation -->
                <nav class="main_nav_container">
                    <div class="main_nav">
                        <ul class="main_nav_list d-flex">
                            <li class="main_nav_item active"><a href="{{ url('Dashboard') }}">Beranda</a></li>
                            <li class="main_nav_item"><a href="{{ url('Dashboard/strukturOrganisasi') }}">Member</a></li>
                            <li class="main_nav_item"><a href="{{ url('Dashboard/peminjamanRuangan') }}">Peminjaman Ruangan</a></li>
                            <li class="main_nav_item"><a href="{{ url('Dashboard/peminjamanBarang') }}">Peminjaman Barang</a></li>
                        </ul>
                    </div>
                </nav>
        
                <div class="dropdown" id="login" style="padding-right: 2%;">
                    <a href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle" style="font-size:30px;"></i>
                    </a>
                    <div class="dropdown-menu" style="width: 250px;">
                        <div class="col-lg-4 mt-2 mb-2">
                            <a class="btn btn-primary" href="{{ route('logins.index') }}">Masuk</a>
                        </div>
                    </div>
                </div>
        
                <!-- Dropdown after login -->
                {{-- 
                <div class="main_nav_item" id="setelahlogin" style="display: none; margin-right: 3%;">
                    <a href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
                        <i class="fa fa-user" style="font-size:12px;color: black;"></i>
                        <script>document.write(getCookie('nama'))</script>
                    </a>
                    <div class="dropdown-menu" style="width: 200px;">
                        <div class="col-lg-12">
                            <button class="btn btn-danger col-lg-8" style="margin:10px;" onclick="logOut()">KELUAR</button>
                        </div>
                    </div>
                </div> 
                --}}
            </div>
        </header>
        
    </div>

    <!-- Home -->
    <center>
        <div class="">
            <!-- Hero Slider -->
            <div class="hero_slider_container">
                <div class="hero_slider owl-carousel">

                    <!-- Hero Slide -->
                    <div class="hero_slide">
                        <div class="hero_slide_background" style="background-image:url({{ asset('assets/foto/beranda.jpg') }})"></div>
                        <div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
                            <div class="hero_slide_content text-center">
                                <h1 data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut">Get your <span style="background: #0059ab;">Education</span> today!</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Other Content -->

        <footer class="footer" style="padding-top: 0px;margin-top: 0px;">
            <div class="container">
                <div class="footer_bar d-flex flex-column flex-sm-row align-items-center">
                    <div class="footer_copyright">
                        <span>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | Polteknik Astra
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/styles/bootstrap4/popper.js') }}"></script>
    <script src="{{ asset('assets/styles/bootstrap4/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/greensock/TweenMax.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/greensock/TimelineMax.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/greensock/animation.gsap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/plugins/scrollTo/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('assets/dist/js/scripts.js') }}"></script>


</html>