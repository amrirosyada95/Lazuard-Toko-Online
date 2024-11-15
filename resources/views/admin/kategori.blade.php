@extends('admin.templates.index')

@section('page-content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ url('admin/tambahkategori') }}" class="btn btn-sm btn-success shadow-sm float-right pull-right"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Kategori</a>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold ">Data Kategori</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="table">
                        <thead class="text-white" style="background-color: #6EC207;">
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th class="col-md-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            @foreach ($kategori as $data)
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td>{{ $data->namakategori }}</td>
                                    <td>
                                        <a href="{{ url('admin/ubahkategori/' . $data->idkategori) }}"
                                            class="fa fa-pen btn btn-success btn-sm"></a>
                                        <a href="{{ url('admin/hapuskategori/' . $data->idkategori) }}"
                                            class="fas fa-trash btn btn-danger btn-sm bdel"></a>
                                    </td>
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
