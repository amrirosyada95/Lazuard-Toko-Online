@extends('home.templates.index')

@section('page-content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('foto/bghome.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span>
                        <span>Keranjang </span>
                    </p>
                    <h2 class="mb-0 bread">Keranjang</h2>
                </div>
            </div>
        </div>
    </section>
    <br>
    <section id="home-section" class="hero">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="bg-#6EC207 text-white">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Foto Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah Beli</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1; ?>
                                @if (!empty(session('keranjang')))
                                    @foreach ($keranjang as $idproduk => $jumlah)
                                        @php
                                            $produk = DB::table('produk')
                                                ->where('idproduk', $idproduk)
                                                ->first();
                                            $totalharga = $produk->hargaproduk * $jumlah;
                                        @endphp
                                        <tr class="text-center">
                                            <td><?php echo $nomor; ?></td>
                                            <td>{{ $produk->namaproduk }}</td>
                                            <td class="image-prod">
                                                <img src="{{ asset('foto/' . $produk->fotoproduk) }}" width="100px"
                                                    style="border-radius: 10px;">
                                            </td>
                                            <td>Rp {{ number_format($produk->hargaproduk) }}</td>
                                            <td>{{ $jumlah }}</td>
                                            <td>Rp {{ number_format($totalharga) }}</td>
                                            <td>
                                                <a href="{{ url('home/hapuskeranjang/' . $produk->idproduk) }}"
                                                    class=" btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php $nomor++; ?>
                                    @endforeach
                                @else
                                    <td colspan="7" align="center">Keranjang Kosong</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row justify-content-center">
                @if (!empty(session('keranjang')))
                    <a href="{{ url('home/checkout') }}" class="btn btn-success">Checkout</a>
                @endif
            </div>
            <br><br>
        </div>
    </section>
@endsection
