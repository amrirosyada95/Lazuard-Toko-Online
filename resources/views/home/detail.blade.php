@extends('home.templates.index')

@section('page-content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ url('foto/bghome.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i
                                    class="fa fa-chevron-right"></i></a></span><span>Detail Produk <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Detail Produk</h2>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Mengatur tampilan container produk agar terlihat lebih elegan */
.ftco-section .row {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Gambar produk dengan efek hover */
.img-product {
    border-radius: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.img-product:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

/* Harga dengan tampilan warna hijau */
.price span {
    color: #28a745;
    font-weight: bold;
    font-size: 24px;
}

/* Tombol beli yang lebih menarik */
.btn-primary {
    background-color: #007bff;
    border: none;
    font-size: 16px;
    font-weight: bold;
    padding: 10px 20px;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    border-radius: 50px;
}

.btn-primary:hover {
    background-color: #0056b3;
    box-shadow: 0 8px 20px rgba(0, 123, 255, 0.5);
}

/* Tampilan sisa produk dengan teks yang lebih tebal */
.product-details p {
    font-size: 16px;
    color: #333;
}

.product-details strong {
    font-size: 18px;
    color: #000;
}

    </style>

    <section class="ftco-section">
    <div class="container">
        <div class="row" style="border: 1px solid #e5e5e5; border-radius: 15px; padding: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="images/prod-1.jpg" class="image-popup prod-img-bg">
                    <img src="{{ asset('foto/' . $produk->fotoproduk) }}" class="img-fluid img-product" alt="{{ $produk->namaproduk }}">
                </a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3>{{ $produk->namaproduk }}</h3>
                <p class="price" style="font-size: 24px; color: #28a745;"><span>Rp. {{ number_format($produk->hargaproduk) }}</span></p>
                <p>{!! $produk->deskripsiproduk !!}</p>
                <div class="row mt-4">
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <p style="color: #000;">Sisa Produk: <strong>{{ number_format($produk->stokproduk) }}</strong></p>
                    </div>
                </div>
                <form method="post" action="{{ url('home/pesan') }}">
                    @csrf
                    <input type="hidden" name="idproduk" value="{{ $produk->idproduk }}">
                    <br><div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" id="jumlah" placeholder="Masukkan Jumlah" min="1" class="form-control" name="jumlah" max="{{ $produk->stokproduk }}" required>
                    </div>
                    <button class="btn btn-primary btn-block" style="border-radius: 50px;" name="beli" type="submit"><strong class="text-white">Beli Sekarang</strong></button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
