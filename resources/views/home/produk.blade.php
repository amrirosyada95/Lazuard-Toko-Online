@extends('home.templates.index')

@section('page-content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('foto/bghome.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span>
                        <span>Produk <i class="fa fa-chevron-right"></i></span>
                    </p>
                    <h2 class="mb-0 bread">Produk</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
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
                <div class="col-md-3 col-6">
                    <center>
                        {{ $produk->links('pagination::bootstrap-4') }}
                    </center>
                </div>
            </div>
        </div>
    </section>
@endsection
