@extends('admin.templates.index')

@section('page-content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ url('admin/tambahproduk') }}" class="btn btn-sm btn-success shadow-sm float-right pull-right"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Produk</a>
        <a href="{{ url('admin/cetakproduk') }}" class="btn btn-sm btn-primary shadow-sm float-right pull-right"><i
                class="fas fa-print fa-sm text-white-50"></i> Cetak Data Produk</a>
    </div>  
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Data Produk</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="table">
                        <thead class="text-white" style="background-color: #6EC207;">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Foto</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            @foreach ($produk as $p)
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td>{{ $p->namaproduk }}</td>
                                    <td>{{ $p->namakategori }}</td>
                                    <td>{{ $p->hargaproduk }}</td>
                                    <td>
                                        <img src="{{ asset('foto/' . $p->fotoproduk) }}" width="100px">
                                    </td>
                                    <td>{{ $p->stokproduk }}</td>
                                    <td>
                                        <a href="{{ url('admin/ubahproduk/' . $p->idproduk) }}"
                                            class="fa fa-pen btn btn-success"></a>
                                        <a href="{{ url('admin/hapusproduk/' . $p->idproduk) }}"
                                            class="fas fa-trash btn btn-danger"></a>
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
@endsection
