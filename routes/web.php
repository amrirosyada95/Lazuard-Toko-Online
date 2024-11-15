<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

// Route::get('/kategori', [KategoriController::class,'index']);

Route::controller(AdminController::class)->group(function () {
    Route::get('admin', 'index');
    Route::get('admin/kategori', 'kategori');
    Route::get('admin/tambahkategori', 'tambahkategori');
    Route::post('admin/simpankategori', 'simpankategori');
    Route::get('admin/ubahkategori/{id}', 'ubahkategori');
    Route::post('admin/updatekategori/{id}', 'updatekategori');
    Route::get('admin/hapuskategori/{id}', 'hapuskategori');

    Route::get('admin/laporan', 'laporan');
    Route::post('admin/pilih-tanggal', 'pilihTanggal');
    Route::get('admin/cetak-laporan/{tanggal_mulai}/{tanggal_selesai}', 'cetakLaporan')->name('admin.cetak-laporan');

    Route::get('admin/produk', 'produk');
    Route::get('admin/cetakproduk', 'cetakproduk');
    Route::get('admin/tambahproduk', 'tambahproduk');
    Route::post('admin/simpanproduk', 'simpanproduk');
    Route::get('admin/ubahproduk/{id}', 'ubahproduk');
    Route::post('admin/updateproduk/{id}', 'updateproduk');
    Route::get('admin/hapusproduk/{id}', 'hapusproduk');

    Route::get('admin/pengguna', 'pengguna');
    Route::get('admin/tambahpengguna', 'tambahpengguna');
    Route::post('admin/simpanpengguna', 'simpanpengguna');
    Route::get('admin/ubahpengguna/{id}', 'ubahpengguna');
    Route::post('admin/updatepengguna/{id}', 'updatepengguna');
    Route::get('admin/hapuspengguna/{id}', 'hapuspengguna');

    Route::get('admin/logout', 'logout');

    Route::get('admin/pembelian', 'pembelian');
    Route::get('admin/pembayaran/{id}', 'pembayaran');
    Route::post('admin/simpanpembayaran/{id}', 'simpanpembayaran');
    Route::get('admin/pembelianhapus/{id}', 'pembelianhapus');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('home', 'index');
    Route::get('home/produk', 'produk');
    Route::get('home/kategori/{id}', 'kategori');
    Route::get('home/detail/{id}', 'detail');

    Route::get('home/login', 'login');
    Route::post('home/dologin', 'dologin');
    Route::get('home/daftar', 'daftar');
    Route::post('home/dodaftar', 'dodaftar');

    Route::get('home/akun', 'akun');
    Route::post('home/ubahakun/{id}', 'ubahakun');

    Route::get('home/keranjang', 'keranjang');
    Route::get('home/hapuskeranjang/{id}', 'hapuskeranjang');
    Route::get('home/checkout', 'checkout');
    Route::post('home/docheckout', 'docheckout');
    Route::get('home/riwayat', 'riwayat');
    Route::get('home/logout', 'logout');

    Route::post('home/pesan', 'pesan');
    Route::get('home/pembayaran/{id}', 'pembayaran');
    Route::get('home/pembeliandetail/{id}', 'pembeliandetail');
    Route::post('home/pembayaransimpan', 'pembayaransimpan');
    Route::post('home/selesai', 'selesai');
});
