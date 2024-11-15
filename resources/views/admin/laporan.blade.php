@extends('admin.templates.index')
@section('page-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1> LAPORAN TRANSAKSI</h1>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-chart-line"></i> PILIH TANGGAL</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ url('admin/pilih-tanggal') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>TANGGAL AWAL</label>
                                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2" style="text-align: center">
                                    <label style="margin-top: 38px;">S/D</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>TANGGAL AKHIR</label>
                                        <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success mr-1 btn-submit btn-block" type="submit" style="margin-top: 30px"><i class="fa fa-filter"></i> FILTER</button>
                                </div>
                                <div class="col-md-2">
                                    @if(request('tanggal_mulai') && request('tanggal_selesai'))
                                        <a href="{{ url('admin/cetak-laporan' , ['tanggal_mulai=' => request('tanggal_mulai'), '&tanggal_selesai=' => request('tanggal_selesai')]) }}" class="btn btn-primary btn-block" style="margin-top: 30px"><i class="fa fa-print"></i> CETAK</a>
                                    @else
                                        <a href="#" class="btn btn-primary btn-block disabled" style="margin-top: 30px"><i class="fa fa-print"></i> CETAK</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                @if (isset($laporan))
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-chart-line"></i> LAPORAN TRANSAKSI</h4>
                        </div>

                        <div class="card-body">

                            <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                        <thead class="bg-danger text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Daftar</th>
                                <th>Tanggal Pembelian</th>
                                <th>Total Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            @foreach ($laporan as $p)
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td>{{ $p->nama }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($dataproduk[$p->idpembelian] as $dp)
                                                <li>
                                                    {{ $dp->namaproduk }} x {{ $dp->jumlah }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ tanggal(date('Y-m-d', strtotime($p->tanggalbeli))) }}</td>
                                    <td>Rp. {{ number_format($p->totalbeli + $p->ongkir) }}</td>
                                </tr>
                                <?php $nomor++; ?>
                            @endforeach

                        </tbody>
                    </table>
                            </div>

                        </div>
                    </div>
                @endif


            </div>
        </section>
    </div>
@stop
