@extends('home.templates.index')

@section('page-content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('foto/bghome.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a>Home <i class="fa fa-chevron-right"></i></a></span>
                        <span>Daftar <i class="fa fa-chevron-right"></i></span>
                    </p>
                    <h2 class="mb-0 bread">Daftar</h2>
                </div>
            </div>
        </div>
    </section>
    <br><br>
    <section id="home-section" class="ftco-section" style="background-image: url('{{ asset('foto/bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; display: flex; justify-content: center; align-items: center; padding: 50px 0;">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="p-4" style="background-color: #D8D2C2; border-radius: 5px; width: 100%; max-width: 500px;">
                @if (session('alert'))
                    <div class="alert alert-primary">{{ session('alert') }}</div>
                @endif
                <form method="post" class="form-horizontal" action="{{ url('home/dodaftar') }}">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Alamat</label>
                        <textarea class="form-control" name="alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Telepon</label>
                        <input type="text" name="telepon" class="form-control">
                    </div>
                    <div class="form-group">
                        <br>
                        <button class="btn btn-success btn-block" name="daftar">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
