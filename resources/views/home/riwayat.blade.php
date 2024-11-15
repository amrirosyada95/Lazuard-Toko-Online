@extends('home.templates.index')

@section('page-content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('foto/bghome.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i
                                    class="fa fa-chevron-right"></i></a></span><span>Riwayat Pembelian <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Riwayat Pembelian</h2>
                </div>
            </div>
        </div>
    </section>
    <br><br>
    <section id="home-section" class="hero" style="background-image: url('{{ asset('foto/bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; display: flex; justify-content: center; align-items: center; padding: 50px 0;">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="bg-#6EC207 text-white">
                            <tr class="text-center">
                                <th width="10px">No</th>
                                <th width="15%">Daftar</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Keterangan</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="border border-botom">
                            <?php $nomor = 1; ?>
                            @foreach ($databeli as $db)
                                <tr>
                                    <td>{{ $nomor }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($dataproduk[$db->idpembelianreal] as $dp)
                                                <li>
                                                    {{ $dp->namaproduk }} x {{ $dp->jumlah }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{!! tanggal($db->tanggalbeli) . '<br>' . date('H:i', strtotime($db->waktu)) !!}</td>
                                    <td>Rp {{ number_format($db->totalbeli + $db->ongkir) }}</td>
                                    <td>
                                        <br>
                                        @if ($db->statusbeli == "Belum Bayar")
                                            <?php 
                                                $deadline = date('Y-m-d H:i', strtotime($db->waktu . ' +1 day'));
                                                $harideadline = date('Y-m-d', strtotime($db->waktu . ' +1 day'));
                                                $jamdeadline = date('H:i', strtotime($db->waktu  . ' +1 day'));
                                            ?>
                                            @if (date('Y-m-d H:i') >= $deadline)
                                                <p class="btn btn-danger m-1">Waktu pembayaran habis, silakan pesan ulang</p>
                                            @else
                                                <a href="{{ url('home/pembayaran/' . $db->idpembelianreal) }}" class="btn btn-warning m-1">
                                                    Upload Bukti Pembayaran Sebelum<br>{{ tanggal($harideadline) . ' - Jam ' . $jamdeadline }} <br>
                                                    <strong>(klik disini untuk bayar & upload bukti)</strong>
                                                </a>
                                            @endif
                                        @elseif ($db->statusbeli == "Sudah Upload Bukti Pembayaran")
                                            <a class="btn btn-danger text-white">Menunggu Konfirmasi Admin</a>
                                        @elseif ($db->statusbeli == "Barang Di Kirim")
                                            <a class="btn btn-success m-1 text-white">Barang Anda Sedang Di Kirim, Mohon Di Tunggu</a>
                                            <br><br>
                                            <p>{{ $db->catatanadmin }}</p>
                                        @elseif ($db->statusbeli == "Barang Telah Sampai ke Pemesan")
                                            <a data-toggle="modal" data-target="#selesai{{ $nomor }}" class="btn btn-success m-1 text-white">Konfirmasi Selesai</a>
                                            <p>{{ $db->catatanadmin }}</p>
                                        @elseif ($db->statusbeli == "Barang Di Kemas")
                                            <a data-toggle="modal" data-target="" class="btn btn-success m-1 text-white">barang sedang dikemas</a>
                                            <p>{{ $db->catatanadmin }}</p>
                                        @elseif ($db->statusbeli == "Selesai")
                                            <p class="btn btn-success m-1 text-white">Selesai</p>
                                        @elseif ($db->statusbeli == "Pesanan Di Tolak")
                                            <a class="btn btn-danger m-1 text-white">Pesanan Anda Di Tolak</a>
                                            <p>{{ $db->catatanadmin }}</p>
                                        @endif
                                    </td>
                                    <td><img width="100px" src="{{ asset('foto/' . $db->bukti) }}" alt=""></td>
                                <td>
                                    <a class="btn btn-info text-white m-1" href="{{ url('home/pembeliandetail/' . $db->idpembelianreal) }}">Detail</a>
                                </td>
                                </tr>
                                <?php $nomor++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


    <?php
    $no = 1;
    $idpembelians = [];
    ?>
    @foreach ($databeli as $data)
        <div class="modal fade" id="selesai<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pesanan Selesai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ url('home/selesai') }}">
                        @csrf
                        <div class="modal-body">
                            <h5>Apakah anda yakin ingin mengkonfirmasi pesanan telah selesai ?</h5>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-contol" value="{{ $data->idpembelian }}" name="idpembelian">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="selesai" value="selesai" class="btn btn-success">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $no++;
        ?>
    @endforeach
    </div>
    <div style="padding-top:250px"></div>
@endsection
