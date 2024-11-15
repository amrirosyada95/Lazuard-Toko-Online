@extends('admin.templates.index')

@section('page-content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pembelian</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>No. Pembelian</th>
                                        <td>: {{ $datapembelian->notransaksi }}</td>
                                        <th>Status Barang</th>
                                        <td>: {{ $datapembelian->statusbeli }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Pembelian</th>
                                        <td>: Rp. {{ number_format($datapembelian->totalbeli) }}</td>
                                        <th>Ongkir</th>
                                        <td>: Rp. {{ number_format($datapembelian->ongkir) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Bayar</th>
                                        <td>: Rp. {{ number_format($datapembelian->totalbeli + $datapembelian->ongkir) }}
                                        </td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered">
                        <thead>
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
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if ($datapembelian->statusbeli != 'Selesai' && $datapembelian->statusbeli != 'Belum Bayar')
            <div class="col-md-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Konfirmasi</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr>
                                        <th>Nama</th>
                                        <th>{{ $pembayaran->nama }}</th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Transfer</th>
                                        <th>{{ tanggal(date('Y-m-d', strtotime($pembayaran->tanggaltransfer))) }}</th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Upload Bukti Pembayaran</th>
                                        <th><?= tanggal(date('Y-m-d', strtotime($pembayaran->tanggal))) ?></th>
                                    </tr>
                                </table>
                                <form method="post"
                                    action="{{ url('admin/simpanpembayaran/' . $datapembelian->idpembelian) }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Catatan Admin</label>
                                        <textarea rows="5" class="form-control" name="catatanadmin">{{ $datapembelian->catatanadmin }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="statusbeli">
                                            <option <?php if ($datapembelian->statusbeli == 'Belum di Konfirmasi') {
                                                echo 'selected';
                                            } ?> value="Belum di Konfirmasi">Belum di Konfirmasi
                                            </option>
                                            <option <?php if ($datapembelian->statusbeli == 'Pesanan Di Tolak') {
                                                echo 'selected';
                                            } ?> value="Pesanan Di Tolak">Pesanan Di Tolak</option>
                                            <option <?php if ($datapembelian->statusbeli == 'Barang Di Kemas') {
                                                echo 'selected';
                                            } ?> value="Barang Di Kemas">Barang Di Kemas</option>
                                            <option <?php if ($datapembelian->statusbeli == 'Barang Di Kirim') {
                                                echo 'selected';
                                            } ?> value="Barang Di Kirim">Barang Di Kirim</option>
                                            <option <?php if ($datapembelian->statusbeli == 'Barang Telah Sampai ke Pemesan') {
                                                echo 'selected';
                                            } ?> value="Barang Telah Sampai ke Pemesan">Barang Telah
                                                Sampai ke Pemesan</option>
                                        </select>
                                    </div>
                                    <button class=" btn btn-danger float-right pull-right" name="proses">Simpan</button>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Bukti Pembayaran</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Bukti Pembayaran</h4>
                            <img src="{{ url('foto/' . $pembayaran->bukti) }}" alt="" class="img-responsive"
                                width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
