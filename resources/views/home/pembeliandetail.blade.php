@extends('home.templates.index')

@section('page-content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('foto/bghome.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span>
                        <span><a href="product.html">Pembayaran <i class="fa fa-chevron-right"></i></a></span>
                    </p>
                    <h2 class="mb-0 bread">Pembayaran</h2>
                </div>
            </div>
        </div>
    </section>
            <table class="table table-bordered">
                <thead class="bg-#6EC207 text-white">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    @foreach ($dataproduk as $dp)
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td>{{ $dp->nama }}</td>
                            <td>Rp. {{ number_format($dp->harga) }}</td>
                            <td>{{ $dp->jumlah }}</td>
                            <td>Rp. {{ number_format($dp->subharga) }}</td>
                        </tr>
                        <?php $nomor++; ?>
                    @endforeach
                </tbody>
            </table>
    <section id="home-section" class="ftco-section">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>No. Pembelian</th>
                                <td>: {{ $datapembelian->notransaksi }}</td>
                                <th>Status Barang</th>
                                <td>:<div style="background-color: #B7B7B7; display: inline">{{ $datapembelian->statusbeli }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Pembelian</th>
                                <td>: Rp. {{ number_format($datapembelian->totalbeli) }}</td>
                                <th>Ongkir</th>
                                <td>: Rp. {{ number_format($datapembelian->ongkir) }}</td>
                            </tr>
                            <tr>
                                <th>Total Bayar</th>
                                <td>: Rp. {{ number_format($datapembelian->totalbeli + $datapembelian->ongkir) }}</td>
                                <th>Nama</th>
                                <td>: {{ $datapembelian->nama }}</td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td>: {{ $datapembelian->telepon }}</td>
                                <th>Email</th>
                                <td>: {{ $datapembelian->email }}</td>
                            </tr>
                            <tr>
                                <th>Kota</th>
                                <td>: {{ $datapembelian->kota }}</td>
                                <th>Alamat Pengiriman</th>
                                <td>: {{ $datapembelian->alamatpengiriman }}</td>
                            </tr>
                            <tr>
                                <th>Catatan User</th>
                                <td colspan="3">: {{ $datapembelian->catatanuser }}</td>
                            </tr>
                            <tr>
                                <th>Catatan Admin</th>
                                <td colspan="3">: {{ $datapembelian->catatanadmin }}</td>
                            </tr>
                            <?php
                            $pembayaran = DB::table('pembayaran')
                                ->where('idpembelian', $datapembelian->idpembelian)
                                ->first();
                                if (!empty($pembayaran)) {
                            ?>
                            <tr>
                                <th>Tanggal Transfer</th>
                                <td colspan="3">: {{ tanggal($pembayaran->tanggaltransfer) }}</td>
                            </tr>
                            <tr>
                                <th>Bukti Pembayaran</th>
                                <td colspan="3"><img src="{{ url('foto/' . $pembayaran->bukti) }}" alt=""
                                        class="img-responsive" width="150px"></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <br>
            
        </div>
    </section>
@endsection
