@extends('home.templates.index')

@section('page-content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('foto/bghome.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0">
                        <span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span>
                        <span>Akun</span>
                    </p>
                    <h2 class="mb-0 bread">Akun</h2>
                </div>
            </div>
        </div>
    </section>
    <br><br>
    <section id="home-section" class="hero" style="background-image: url('{{ asset('foto/bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; display: flex; justify-content: center; align-items: center; padding: 50px 0;" style="padding: 50px 0;">
        <form method="post" enctype="multipart/form-data" action="{{ url('home/ubahakun/' . $pengguna->id) }}">
            @csrf
            <div class="container mt-4" style="background-color: #D8D2C2; border-radius: 5px">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input value="{{ $pengguna->nama }}" type="text" class="form-control" name="nama">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input value="{{ $pengguna->email }}" type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input value="{{ $pengguna->telepon }}" type="tel" class="form-control" name="telepon">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="5">{{ $pengguna->alamat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                            <input type="hidden" class="form-control" name="passwordlama" value="{{ $pengguna->password }}">
                            <span class="text-primary">Kosongkan Password jika tidak ingin mengganti</span>
                        </div>
                        <div style="display: flex; justify-content: center;">
                            <button class="btn btn-success mb-5" name="ubah">
                                    <i class="glyphicon glyphicon-saved"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- Script untuk CKEditor dipisah dari form -->
    <script>
        CKEDITOR.replace('alamat');
    </script>
@endsection
