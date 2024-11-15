@extends('home.templates.index')

@section('page-content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ url('foto/bghome.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span>
                        <span>Kategori <i class="fa fa-chevron-right"></i></span>
                    </p>
                    <h2 class="mb-0 bread">Kategori</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row mb-3 pb-3">
                <div class="col-md-12 heading-section ftco-animate">
                    <h4 class="text-center mb-4"><strong>Kategori : {{ $kategori->namakategori }}</strong></h4>
                    @if (empty($produk))
                        <div class="alert alert-danger">Produk <strong>{{ $kategori->namakategori }}</strong> Kosong</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($produk as $p)
                    <div class="col-md-4 ftco-animate">
                        <div class="product">
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
                            <div class="text py-3 pb-4 px-3 text-center">
                                <div class="text text-center">
                                    <h2>{{ $p->namaproduk }}</h2>
                                    <p class="mb-0"><span class="price price-sale"></span> <span class="price">Rp
                                            {{ number_format($p->hargaproduk) }}</span></p>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">

                                        <a href="{{ url('home/detail/' . $p->idproduk) }}"
                                            class="buy-now d-flex justify-content-center align-items-center mx-1">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
