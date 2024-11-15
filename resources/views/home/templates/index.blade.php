<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lazuard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link
        href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assets/home/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/home/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/home/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('foto/icon.png') }}">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

</head>

<style>
    /* Mengatur dropdown agar lebih menarik */
.dropdown-custom {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    padding: 10px;
}

/* Mengatur item di dalam dropdown */
.dropdown-custom-item {
    color: #333333;
    font-size: 16px;
    padding: 10px 20px;
    margin: 5px 0;
    border-radius: 6px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Hover effect untuk item dropdown */
.dropdown-custom-item:hover {
    background-color: #007bff;
    color: #ffffff;
    text-decoration: none;
}

/* Mengatur dropdown agar muncul dari bawah dengan animasi */
.dropdown-menu {
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.3s ease;
}

/* Dropdown menjadi terlihat saat aktif */
.dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Mengatur link dropdown agar memiliki tampilan lebih tebal */
.nav-link.dropdown-toggle {
    color: #333333;
    font-weight: bold;
    position: relative;
}

/* Menambahkan efek animasi pada dropdown-toggle */
.nav-link.dropdown-toggle::after {
    content: "\25BC"; /* Panah bawah */
    font-size: 12px;
    margin-left: 8px;
    transition: transform 0.3s ease;
}

/* Saat hover panah berubah posisi */
.dropdown:hover .nav-link.dropdown-toggle::after {
    transform: rotate(180deg);
}

/* Menambahkan animasi shadow pada hover */
.dropdown:hover .dropdown-custom {
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
}

</style>


@if (session('alert'))
    <script>
        alert("{{ session('alert') }}");
    </script>
@endif
<div class="wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <center>
                </center>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-danger ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar"
    style="background-color: green;">
    <div class="container">
        <a class="navbar-brand text-dark" href="{{ url('home') }}"> <img src="{{ asset('foto/icon.png') }}"
                width="50px" style="border-radius: 10px;">&nbsp;<span class="text-dark">Lazuard&nbsp;</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-list"></i>
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ url('home') }}" class="nav-link text-dark font-weight-bold">Home</a></li>
                <li class="nav-item active"><a href="{{ url('home/produk') }}" class="nav-link text-dark font-weight-bold">Produk</a>
                </li>
                <li class="nav-item active dropdown">
                    <a class="nav-link dropdown-toggle text-dark font-weight-bold" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
                    <div class="dropdown-menu dropdown-custom" aria-labelledby="dropdown03">
                        @php
                            $datakategori = DB::table('kategori')->get();
                        @endphp
                        @foreach ($datakategori as $key => $value)
                            <a href="{{ url('home/kategori/' . $value->idkategori) }}" class="dropdown-item dropdown-custom-item">{{ $value->namakategori }}</a>
                        @endforeach
                    </div>
                </li>

                @if (session('pengguna'))
                    <?php $akun = session('pengguna'); ?>
                    <li class="nav-item active">
                        <a class="nav-link text-dark font-weight-bold" href="{{ url('home/keranjang') }}">Keranjang</a>
                    </li>
                    <li class="nav-item active dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Akun</a>
                        <div class="dropdown-menu dropdown-custom" aria-labelledby="dropdown04">
                            <a class="dropdown-item dropdown-custom-item" href="{{ url('home/akun') }}">Profil Akun</a>
                            <a class="dropdown-item dropdown-custom-item" href="{{ url('home/riwayat') }}">Riwayat Pembelian</a>
                            <a class="dropdown-item dropdown-custom-item" href="{{ url('home/logout') }}">Logout</a>
                        </div>
                    </li>

                @else
                    <li class="nav-item active"><a href="{{ url('home/daftar') }}"
                            class="nav-link text-dark font-weight-bold">Daftar</a>
                    </li>
                    <li class="nav-item active"><a href="{{ url('home/login') }}" class="nav-link text-dark font-weight-bold">Login</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>

@yield('page-content')

<footer style="background-color: #B7B7B7; padding: 20px; text-align: center;">
    <div>
        <h4>Alamat Kami</h4>
        <p>Desa Gemblengan, Kecamatan Garung, Kabupaten Wonosobo</p>
    </div>
    
    <div>
        <h4>Kontak</h4>
        <p>Email: <a href="mailto:agro.jagad95@gmail.com">agro.jagad95@gmail.com</a></p>
        <p>Telepon: <a href="tel:085225095083">0852-2509-5083</a></p>
    </div>
    
    <div>
        <h4>Sosial Media</h4>
        <a href="https://www.facebook.com" target="_blank">Facebook</a> |
        <a href="https://www.twitter.com" target="_blank">Twitter</a> |
        <a href="https://www.instagram.com" target="_blank">Instagram</a> |
        <a href="https://www.linkedin.com" target="_blank">LinkedIn</a>
    </div>

    <div style="margin-top: 20px;">
        <p>&copy; 2024 PT.Lazuard Agritech. All rights reserved.</p>
    </div>
</footer>
<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
            stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
            stroke-miterlimit="5" stroke="#F96D00" />
    </svg></div>

<script src="{{ asset('assets/home/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/home/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('assets/home/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/home/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/home/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('assets/home/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/home/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('assets/home/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/home/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/home/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('assets/home/js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&sensor=false"></script>
<script src="{{ asset('assets/home/js/google-map.js') }}"></script>
<script src="{{ asset('assets/home/js/main.js') }}"></script>


</body>

</html>
