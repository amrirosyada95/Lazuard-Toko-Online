<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $produk = DB::table('produk')->leftJoin('kategori', 'produk.idkategori', '=', 'kategori.idkategori')->orderBy('idproduk', 'desc')->limit(3)->get();
        $data = [
            'produk' => $produk,
        ];

        return view('home/index', $data);
    }

    public function produk()
    {
        $produk = DB::table('produk')->leftJoin('kategori', 'produk.idkategori', '=', 'kategori.idkategori')->orderBy('idproduk', 'desc')->paginate(9);;
        $data = [
            'produk' => $produk,
        ];
        return view('home/produk', $data);
    }

    public function kategori($id)
    {
        $produk = DB::table('produk')->leftJoin('kategori', 'produk.idkategori', '=', 'kategori.idkategori')->where('produk.idkategori', $id)->get();
        $kategori = DB::table('kategori')->where('idkategori', $id)->first();

        $data = [
            'produk' => $produk,
            'kategori' => $kategori,
        ];

        return view('home.kategori', $data);
    }

    public function detail($id)
    {
        $produk = DB::table('produk')->where('idproduk', $id)->first();
        $data = [
            'produk' => $produk,
        ];
        return view('home.detail', $data);
    }

    public function daftar()
    {
        return view('home.daftar');
    }

    public function dodaftar(Request $request)
    {
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = $request->input('password');
        $alamat = $request->input('alamat');
        $telepon = $request->input('telepon');
        $existingUser = DB::table('pengguna')->where('email', $email)->count();

        if ($existingUser == 1) {
            return redirect()->back()->with('alert', 'Pendaftaran Gagal, email sudah ada');
        } else {
            DB::table('pengguna')->insert([
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'alamat' => $alamat,
                'telepon' => $telepon,
                'level' => 'Pelanggan'
            ]);

            return redirect('home/login')->with('alert', 'Pendaftaran Berhasil');
        }
    }

    public function login()
    {
        return view('home.login');
    }

    public function dologin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $akun = DB::table('pengguna')
            ->where('email', $email)
            ->where('password', $password)
            ->first();

        if ($akun) {
            if ($akun->level == "Pelanggan") {
                session(['pengguna' => $akun]);
                return redirect('home')->with('alert', 'Anda sukses login');
            } elseif ($akun->level == "Admin") {
                session(['admin' => $akun]);
                return redirect('admin')->with('alert', 'Anda sukses login');
            }
        } else {
            return redirect()->back()->with('alert', 'Anda gagal login, Cek akun anda');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('home')->with('alert', 'Anda Telah Logout');
    }

    public function akun()
    {
        if (!session('pengguna')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login'); // Ganti dengan URL halaman login Anda 
        }

        $idpengguna = session('pengguna')->id;
        $pengguna = DB::table('pengguna')->where('id', $idpengguna)->first();

        $data = [
            'pengguna' => $pengguna,
        ];
        return view('home.akun', $data);
    }

    public function ubahakun(Request $request, $id)
    {
        $password = $request->input('password');
        if (empty($password)) {
            $password = $request->input('passwordlama');
        }
        DB::table('pengguna')
            ->where('id', $id)
            ->update([
                'password' => $password,
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'telepon' => $request->input('telepon'),
                'alamat' => $request->input('alamat'),
            ]);

        return redirect('home/akun');
    }

    public function pesan(Request $request)
    {
        if (!session('pengguna')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login'); // Ganti dengan URL halaman login Anda 
        }

        $idproduk = $request->input('idproduk');
        $jumlah = $request->input('jumlah');
        $keranjang = session()->get('keranjang');

        if ($keranjang === null) {
            // Jika keranjang tidak ada dalam sesi, inisialisasi sebagai array kosong
            $keranjang = [];
        }

        if (isset($keranjang[$idproduk])) {
            $keranjang[$idproduk] += $jumlah;
        } else {
            $keranjang[$idproduk] = $jumlah;
        }

        session(['keranjang' => $keranjang]);
        session()->flash('alert', 'Berhasil menambahkan barang ke keranjang');
        return redirect('home/keranjang');
    }

    public function keranjang()
    {
        if (!session('pengguna')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login'); // Ganti dengan URL halaman login Anda 
        }
        $keranjang = session()->get('keranjang');
        $data = [
            'keranjang' => $keranjang,
        ];

        return view('home.keranjang', $data);
    }

    public function hapuskeranjang($id)
    {
        $keranjang = session()->get('keranjang'); // Ambil keranjang dari sesi

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]); // Hapus item keranjang berdasarkan ID produk
            session(['keranjang' => $keranjang]); // Simpan kembali keranjang yang telah dihapus ke sesi
        }
        return redirect('home/keranjang');
    }

    public function checkout()
    {
        if (!session('pengguna')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login'); // Ganti dengan URL halaman login Anda 
        }
        $keranjang = session()->get('keranjang'); // Ambil keranjang dari sesi'
        $data['keranjang'] = $keranjang;

        $caripengguna = session('pengguna')->id;
        $pengguna = DB::table('pengguna')->where('id', $caripengguna)->first();
        $data['pengguna'] = $pengguna;
        return view('home.checkout', $data);
    }

    public function docheckout(Request $request)
    {
        $notransaksi = '#TP' . date("Ymdhis");
        $id = session('pengguna')->id;
        $tanggalbeli = date("Y-m-d");
        $waktu = date("Y-m-d H:i:s");
        $totalbeli = $request->input('dua');
        $alamatpengirim = $request->input('alamatpengiriman');
        $kota = $request->input('kota');
        $ongkir = $request->input('ongkir');
        $catatanuser = $request->input('catatanuser');

        DB::table('pembelian')->insert([
            'notransaksi' => $notransaksi,
            'id' => $id,
            'tanggalbeli' => $tanggalbeli,
            'totalbeli' => $totalbeli,
            'alamatpengiriman' => $alamatpengirim,
            'kota' => $kota,
            'ongkir' => $ongkir,
            'statusbeli' => 'Belum Bayar',
            'catatanadmin' => '',
            'catatanuser' => $catatanuser,
            'waktu' => $waktu,
        ]);

        $keranjang = session()->get('keranjang');
        $idpembelian = DB::getPdo()->lastInsertId();

        foreach ($keranjang as $idproduk => $jumlah) {
            $produk = DB::table('produk')->where('idproduk', $idproduk)->first();
            $idproduk = $produk->idproduk;
            $nama = $produk->namaproduk;
            $harga = $produk->hargaproduk;

            $subharga = $produk->hargaproduk * $jumlah;

            DB::table('pembelianproduk')->insert([
                'idpembelian' => $idpembelian,
                'idproduk' => $idproduk,
                'nama' => $nama,
                'harga' => $harga,
                'subharga' => $subharga,
                'jumlah' => $jumlah,
            ]);
        }


        session()->forget('keranjang');
        session()->flash('alert', 'Berhasil Checkout');
        return redirect('home/riwayat');
    }

    public function riwayat()
    {
        if (!session('pengguna')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login'); // Ganti dengan URL halaman login Anda 
        }
        $idpengguna = session('pengguna')->id;
        $databeli = DB::table('pembelian')
            ->leftJoin('pembayaran', 'pembelian.idpembelian', '=', 'pembayaran.idpembelian')
            ->select('*', 'pembelian.idpembelian as idpembelianreal')
            ->where('pembelian.id', $idpengguna)
            ->orderBy('pembelian.tanggalbeli', 'desc')
            ->orderBy('pembelian.idpembelian', 'desc')
            ->get();

        $dataproduk = [];
        foreach ($databeli as $row) {
            $idpembelian = $row->idpembelianreal;
            $produk = DB::table('pembelianproduk')
                ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
                ->where('idpembelian', $idpembelian)
                ->get();
            $dataproduk[$idpembelian] = $produk;
        }

        $data = [
            'databeli' => $databeli,
            'dataproduk' => $dataproduk,
        ];

        return view('home.riwayat', $data);
    }

    public function pembayaran($id)
    {
        if (!session('pengguna')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login'); // Ganti dengan URL halaman login Anda 
        }
        $datapembelian = DB::table('pembelian')->join('pengguna', 'pengguna.id', '=', 'pembelian.id')
            ->where('pembelian.idpembelian', $id)->first();
        $dataproduk = DB::table('pembelianproduk')
            ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
            ->where('idpembelian', $id)
            ->get();

        $data = [
            'datapembelian' => $datapembelian,
            'dataproduk' => $dataproduk,
        ];

        return view('home.pembayaran', $data);
    }

    public function pembeliandetail($id)
    {
        if (!session('pengguna')) { // Ganti dengan kondisi atau metode sesuai implementasi Anda
            // Alihkan pengguna ke halaman login
            session()->flash('alert', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login'); // Ganti dengan URL halaman login Anda 
        }
        $datapembelian = DB::table('pembelian')->join('pengguna', 'pengguna.id', '=', 'pembelian.id')
            ->where('pembelian.idpembelian', $id)->first();
        $dataproduk = DB::table('pembelianproduk')
            ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
            ->where('idpembelian', $id)
            ->get();

        $data = [
            'datapembelian' => $datapembelian,
            'dataproduk' => $dataproduk,
        ];

        return view('home.pembeliandetail', $data);
    }

    public function pembayaransimpan(Request $request)
    {
        $namabukti = $request->file('bukti')->getClientOriginalName();
        $namafix = date("YmdHis") . $namabukti;
        $request->file('bukti')->move('foto', $namafix);

        $idpembelian = $request->input('idpembelian');
        $nama = $request->input('nama');
        $tanggaltransfer = $request->input('tanggaltransfer');
        $tanggal = date("Y-m-d");

        DB::table('pembayaran')->insert([
            'idpembelian' => $idpembelian,
            'nama' => $nama,
            'tanggaltransfer' => $tanggaltransfer,
            'tanggal' => $tanggal,
            'bukti' => $namafix,
        ]);

        DB::table('pembelian')->where('idpembelian', $idpembelian)->update([
            'statusbeli' => 'Sudah Upload Bukti Pembayaran',
        ]);

        return redirect('home/riwayat')->with('alert', 'Terima kasih, Mohon menunggu konfirmasi admin');
    }

    public function selesai(Request $request)
    {
        $idpembelian = $request->input('idpembelian');
        DB::table('pembelian')->where('idpembelian', $idpembelian)->update([
            'statusbeli' => 'Selesai'
        ]);
        return redirect('home/riwayat');
    }
}
