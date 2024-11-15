@if (!session('admin'))
    <script>
        alert('Anda Harus Login');
        location = '{{ url('home/login') }}';
    </script>
@endif
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lazuard - Admin</title>
    <link href="{{ asset('assets/admin/css/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('assets/admin/css/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet"
        href="{{ asset('assets/admin/assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}">
    <link href="{{ asset('assets/admin/css/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <script src="{{ asset('assets/admin/assets/ckeditor/ckeditor.js') }}"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('foto/icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" rel=" stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #6EC207;">
            <a class="sidebar-brand d-flex align-items-center justify-content-center text-white"
                href="{{ url('admin') }}">
                <div class="sidebar-brand-text mx-3">Lazuard</sup></div>
            </a>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('admin') }}">
                    <i class="fas fa-fw fa-book text-white"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('admin/kategori') }}">
                    <i class="fas fa-fw fa-list text-white"></i>
                    <span>Kategori</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('admin/produk') }}">
                    <i class="fas fa-fw fa-pen text-white"></i>
                    <span>Produk</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('admin/pembelian') }}">
                    <i class="fas fa-fw fa-dollar-sign text-white"></i>
                    <span>Transaksi</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('admin/laporan') }}">
                    <i class="fas fa-fw fa-file-alt text-white"></i>
                    <span>Laporan Transaksi</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('admin/pengguna') }}">
                    <i class="fas fa-fw fa-users text-white"></i>
                    <span>Akun Member</span></a>
            </li>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h1 class="mt-1 text-center">hallo admin</h1>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?');" class="nav-link"
                                href="{{ url('admin/logout') }}">
                                <span class="mr-2 d-none d-lg-inline text-white small"><button class="btn btn-danger text-white text-bold" style="border: 0px; border-radius: 5px; padding: 7px;">Keluar</button></span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div id="page-inner">
                        @if (Session::has('alert'))
                            <div class="alert alert-primary">
                                {{ Session::get('alert') }}
                            </div>
                        @endif
                        @yield('page-content')
                    </div>
                </div>
            </div>
            <script src="{{ asset('assets/admin/assets/js/jquery-1.10.2.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/js/jquery.metisMenu.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/js/morris/raphael-2.1.0.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/js/morris/morris.js') }}"></script>
            <script src="{{ asset('assets/admin/css/js/sb-admin-2.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/js/jquery.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}">
            </script>
            <script src="{{ asset('assets/admin/assets/DataTables/JSZip-2.5.0/jszip.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/Buttons-1.5.6/js/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/Buttons-1.5.6/js/buttons.print.min.js') }}"></script>
            <script src="{{ asset('assets/admin/assets/DataTables/Buttons-1.5.6/js/buttons.colvis.min.js') }}"></script>
            <script>
                $(document).ready(function() {
                    var table = $('#table').DataTable({
                        buttons: ['csv', 'print', 'excel', 'pdf'],
                        dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                            "<'row'<'col-md-12'tr>>" +
                            "<'row'<'col-md-5'i><'col-md-7'p>>",
                        lengthMenu: [
                            [5, 10, 25, 50, 100, -1],
                            [5, 10, 25, 50, 100, "ALL"]
                        ]
                    });

                    table.buttons().container()
                        .appendTo('#table_wrapper .col-md-5:eq(0)');
                });
            </script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
            <script>
                $(function() {
                    @if ($message = session('success'))
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '<?= session('success') ?>'
                        })
                    @endif
                });
                $(function() {
                    @if ($message = session('error'))
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '<?= session('error') ?>'
                        })
                    @endif
                });
                const flashData = $('.flash-data').data('flashdata');
                // console.log(flashData);
                if (flashData) {
                    Swal.fire({
                        title: 'Berhasil !',
                        text: '' + flashData,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
                const flashDataError = $('.flash-data-error').data('flashdata');
                // console.log(flashData);
                if (flashDataError) {
                    Swal.fire({
                        title: 'Gagal !',
                        text: '' + flashDataError,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
                $('.bdel').on('click', function(e) {
                    e.preventDefault();
                    const href = $(this).attr('href');
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success m-1',
                            cancelButton: 'btn btn-danger m-1'
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: 'Yakin data ini akan dihapus?',
                        text: "Data tidak akan bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            document.location.href = href;
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                'Dibatalkan',
                                '',
                                'error'
                            )
                        }
                    });
                });
                $('.blogout').on('click', function(e) {
                    e.preventDefault();
                    const href = $(this).attr('href');
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success m-1',
                            cancelButton: 'btn btn-danger m-1'
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: 'Apakah anda yakin ingin logout',
                        text: "Anda akan keluar",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Logout!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            document.location.href = href;
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                'Dibatalkan',
                                '',
                                'error'
                            )
                        }
                    });
                });
                $('.bconfir').on('click', function(e) {
                    e.preventDefault();
                    const href = $(this).attr('href');
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: 'INFO',
                        text: "Dengan mengklik tombol 'Ya', notifikasi tagihan SPP akan masuk ke ruang orang tua/wali.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya !',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            document.location.href = href;
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                'Dibatalkan',
                                '',
                                'error'
                            )
                        }
                    });
                });
            </script>
</body>

</html>
