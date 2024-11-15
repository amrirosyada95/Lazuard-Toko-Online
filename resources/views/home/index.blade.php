@extends('home.templates.index')

@section('page-content')

    <div class="hero-wrap" style="background-image: url('{{ asset('foto/bghome.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-8 ftco-animate d-flex align-items-end">
                    <div class="text w-100 text-center" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 200px">
                    <a class="text-dark" href="{{ url('home') }}"> <img src="{{ asset('foto/icon.png') }}"
                    width="250px" style="border-radius: 10px;">&nbsp;<span class="text-bolder text-white" style="font-size: 100px">Lazuard&nbsp;</span></a>
                    <br><p class="" style="position: absolute; top: 160px; left: 365px; z-index: 10; font-size: 40px">Green House</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-intro" style="background-color: green;">
        <div class="container">
            <!-- <div class="row no-gutters">
                <div class="col-md-4 d-flex">
                    <div class="intro d-lg-flex w-100 ftco-animate" style="background-color: green;">
                        <div class="icon">
                            <span class="flaticon-free-delivery"></span>
                        </div>
                        <div class="text">
                            <h2>Pengiriman Cepat</h2>
                            <p>kami akan mengirim pesanan pada hari yang sama dengan jasa kurir terpercaya</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="intro color-1 d-lg-flex w-100 ftco-animate" style="background-color: green;">
                        <div class="icon">
                            <span class="flaticon-cashback"></span>
                        </div>
                        <div class="text">
                            <h2>Harga Ekonomis</h2>
                            <p>Harga yang ekonomis dengan jaminan kualitas</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="intro color-2 d-lg-flex w-100 ftco-animate" style="background-color: green;">
                        <div class="icon">
                            <span class="flaticon-shopping-bag"></span>
                        </div>
                        <div class="text">
                            <h2>Barang Original</h2>
                            <p>Produk yang kami jual adalah produk original</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-7 heading-section text-center ftco-animate ">
                    <h2>Produk Kami</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($produk as $p)
                    <div class="col-md-4 d-flex">
                        <div class="product ftco-animate">
                            <div class="img d-flex align-items-center justify-content-center"
                                style="background-image: url('{{ asset('foto/' . $p->fotoproduk) }}');">
                                <div class="desc">
                                    <p class="meta-prod d-flex">
                                        <a href="{{ url('home/detail/' . $p->idproduk) }}"
                                            class="d-flex align-items-center justify-content-center"><span
                                                class="">Lihat Detail Produk</span></a>
                                    </p>
                                </div>
                            </div>
                            <div class="text text-center">
                                <span class="category">{{ $p->namakategori }}</span>
                                <h2>{{ $p->namaproduk }}</h2>
                                <p class="mb-0"><span class="price price-sale"></span> <span class="price">Rp
                                        {{ number_format($p->hargaproduk) }}</span></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <a href="{{ url('home/produk') }}" class="btn btn-success d-block">Lihat Semua Produk</a>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pb ">
        <div class="container">
            <h3 class="text-center mb-5">Tentang kami</h3>
            <div class="row justify-content-center pb-5">
                <div class="col-md-4 img img-3 d-flex justify-content-center align-items-center">
                    <img src="{{ asset('foto/aboutus1.jpg') }}" width="100%" style="border-radius: 10px">
                </div>
                <div class="col-md-4 img img-3 d-flex justify-content-center align-items-center">
                    <img src="{{ asset('foto/BROSUR-01.jpg') }}" width="100%" style="border-radius: 10px">
                </div>
                <div class="col-md-4 img img-3 d-flex justify-content-center align-items-center">
                    <img src="{{ asset('foto/aboutus2.jpg') }}" width="100%" style="border-radius: 10px">
                </div>
                <div class="wrap-about pl-md-5 ftco-animate py-5">
                    <div class="heading-section text-center">
                        <p class="text-justify">PT. LAZUARD AGRITECH INDONESIA adalah perusahaan yang bergerak dibidang jasa pemeliharaan, produksi dan pembangunan kontruksi Green House yang sudah berpengalaman sejak 2013. Dan kami juga menyediakan spare part konstruksi Green House yang tersedia pada website kami ini, yang tentunya dengan kualitas yang terjamin dan terpercaya.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

