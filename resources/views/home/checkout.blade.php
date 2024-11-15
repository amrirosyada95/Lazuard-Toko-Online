@extends('home.templates.index')

@section('page-content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('foto/bghome.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span>
                        <span><a href="product.html">Check Out <i class="fa fa-chevron-right"></i></a></span>
                    </p>
                    <h2 class="mb-0 bread">Check Out</h2>
                </div>
            </div>
        </div>
    </section>
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
                                    <th>Harga</th>
                                    <th>Jumlah Beli</th>
                                    <th>SubHarga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1; ?>
                                <?php $totalberat = 0; ?>
                                <?php $totalbelanja = 0; ?>
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
                                            <td>Rp {{ number_format($produk->hargaproduk) }}</td>
                                            <td>{{ $jumlah }}</td>
                                            <td>Rp {{ number_format($totalharga) }}</td>
                                        </tr>
                                        <?php $nomor++; ?>
                                        <?php $totalbelanja += $totalharga; ?>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                    <form method="post" action="{{ url('home/docheckout') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Nama Pelanggan</strong></label>
                                    <input type="text" readonly value="{{ session('pengguna')->nama }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label><strong>No. Handphone Pelanggan</strong></label>
                                    <input type="text" readonly value="{{ session('pengguna')->telepon }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label><strong>provinsi Pengiriman</strong></label>
                                    <select name="kota" class="form-control" required id="Sone" onchange="check()">
                                        <option value="">Pilih Provinsi</option>
                                        <option value="Aceh">Aceh</option>
                                        <option value="Sumatera Utara">Sumatera Utara</option>
                                        <option value="Sumatera Barat">Sumatera Barat</option>
                                        <option value="Riau">Riau</option>
                                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                                        <option value="Jambi">Jambi</option>
                                        <option value="Bengkulu">Bengkulu</option>
                                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                                        <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
                                        <option value="Lampung">Lampung</option>
                                        <option value="Banten">Banten</option>
                                        <option value="DKI Jakarta">DKI Jakarta</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="DI Yogyakarta">DI Yogyakarta</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                                        <option value="Gorontalo">Gorontalo</option>
                                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                        <option value="Maluku">Maluku</option>
                                        <option value="Maluku Utara">Maluku Utara</option>
                                        <option value="Papua Barat">Papua Barat</option>
                                        <option value="Papua">Papua</option>
                                        <option value="Papua Tengah">Papua Tengah</option>
                                        <option value="Papua Pegunungan">Papua Pegunungan</option>
                                        <option value="Papua Selatan">Papua Selatan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><strong>Alamat Lengkap Pengiriman</strong></label>
                                    <input type="hidden" name="totalberatnya" value="{{ $totalberat }}">
                                    <textarea class="form-control" name="alamatpengiriman" placeholder="Masukkan Alamat"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" id="dua" name="dua" value="{{ $totalbelanja }}">
                                <div class="form-group">
                                    <label><strong>Ongkir Pengiriman</strong></label>
                                    <input class="form-control" name="ongkir" type="number" readonly required
                                        id="res">
                                </div>
                                <div class="form-group">
                                    <label><strong>Total Belanja + Ongkir</strong></label>
                                    <input class="form-control" id="result" required readonly type="number">
                                </div>
                                <div class="form-group">
                                    <label><strong>Catatan & Lampiran</strong></label>
                                    <textarea class="form-control" name="catatanuser" required rows="7"
                                        placeholder="Tulisan catatan disini"></textarea>
                                </div>
                                <button style="width: 100%; padding: 15px; font-size: 1.2rem;" class="btn btn-danger pull-right btn-lg" name="checkout">Checkout</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function check() {
            var val = document.getElementById('Sone').value;
            if (val == 'Aceh') {
                document.getElementById('res').value = "5000";
            } else if (val == 'Sumatera Utara') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Sumatera Barat') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Riau') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Kepulauan Riau') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Jambi') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Bengkulu') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Sumatera Selatan') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Kepulauan Bangka Belitung') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Lampung') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Banten') {
                document.getElementById('res').value = "10000";
            } else if (val == 'DKI Jakarta') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Jawa Barat') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Jawa Tengah') {
                document.getElementById('res').value = "10000";
            } else if (val == 'DI Yogyakarta') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Jawa Timur') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Bali') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Nusa Tenggara Barat') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Nusa Tenggara Timur') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Kalimantan Barat') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Kalimantan Tengah') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Kalimantan Selatan') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Kalimantan Timur') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Kalimantan Utara') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Sulawesi Utara') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Gorontalo') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Sulawesi Tengah') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Sulawesi Barat') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Sulawesi Selatan') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Sulawesi Tenggara') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Maluku') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Maluku Utara') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Papua Barat') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Papua') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Papua Tengah') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Papua Pegunungan') {
                document.getElementById('res').value = "10000";
            } else if (val == 'Papua Selatan') {
                document.getElementById('res').value = "10000";
            }
            
            var num1 = document.getElementById("res").value;
            var num2 = document.getElementById("dua").value;
            result = parseInt(num1) + parseInt(num2);
            document.getElementById("result").value = result;
        }
    </script>
@endsection
