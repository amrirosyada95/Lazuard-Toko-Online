@extends('admin.templates.index')

@section('page-content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Member</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="table">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            @foreach ($pengguna as $pecah)
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td>{{ $pecah->nama }}</td>
                                    <td>{{ $pecah->email }}</td>
                                    <td>{{ $pecah->telepon }}</td>
                                    <td>{{ $pecah->alamat }}</td>
                                    <td>
                                        <a href="{{ url('admin/hapuspengguna/' . $pecah->id) }}"
                                            class="fas fa-trash btn btn-danger bdel"></a>
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