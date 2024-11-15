<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index()
    {
        $data['jumlahkategori'] = DB::table('kategori')->count();
        $data['jumlahproduk'] = DB::table('produk')->count();
        $data['jumlahtransaksi'] = DB::table('pembelian')->where('statusbeli', '<>', 'Belum Bayar')->count();
        $data['jumlahmember'] = DB::table('pengguna')->where('level', '<>', 'Pelanggan')->count();
        return view('admin.dashboard', $data);
    }
    public function laporan()
    {
        return view('admin.laporan');
    }

    public function pilihTanggal(Request $request)
    {
        $pembelian = DB::table('pembelian')
            ->join('pengguna', 'pengguna.id', '=', 'pembelian.id')
            ->where('statusbeli', '<>', 'Belum Bayar')
            ->orderBy('pembelian.tanggalbeli', 'desc')
            ->orderBy('pembelian.idpembelian', 'desc')
            ->select('pembelian.*', 'pengguna.nama')
            ->get();

        $dataproduk = [];
        foreach ($pembelian as $row) {
            $idpembelian = $row->idpembelian;
            $produk = DB::table('pembelianproduk')
                ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
                ->where('idpembelian', $idpembelian)
                ->get();
            $dataproduk[$idpembelian] = $produk;
        }
        
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        $laporan = DB::table('pembelian')
            ->join('pengguna', 'pengguna.id', '=', 'pembelian.id')
            ->whereBetween('tanggalbeli', [$tanggalMulai, $tanggalSelesai])
            ->select('pembelian.*', 'pengguna.nama')
            ->get();

        $data = [
            'laporan' => $laporan,
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'dataproduk' => $dataproduk,
        ];

        return view('admin.laporan', $data);
    }

    public function cetakLaporan($tanggal_mulai, $tanggal_selesai)
    {      

        $laporan = DB::table('pembelian')
            ->join('pengguna', 'pengguna.id', '=', 'pembelian.id')
            ->whereBetween('tanggalbeli', [$tanggal_mulai, $tanggal_selesai])
            ->select('pembelian.*', 'pengguna.nama')
            ->get();

        $dataproduk = [];
        foreach ($laporan as $row) {
            $idpembelian = $row->idpembelian;
            $produk = DB::table('pembelianproduk')
                ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
                ->where('idpembelian', $idpembelian)
                ->get();
            $dataproduk[$idpembelian] = $produk;
        }

        $data = [
            'laporan' => $laporan,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'dataproduk' => $dataproduk,
        ];

        $pdf = Pdf::loadView('admin.cetaklaporan', $data);
        return $pdf->download('laporan_transaksi.pdf');
    }
    public function cetakproduk()
    {
        $produk = DB::table('produk')
            ->join('kategori', 'produk.idkategori', '=', 'kategori.idkategori')
            ->select('produk.*', 'kategori.namakategori')
            ->get();
        $tanggalHariIni = \Carbon\Carbon::now()->format('d-m-Y');
        $data = [
            'produk' => $produk,
        ];
    
       $data['tanggalHariIni'] = $tanggalHariIni;
       $pdf = Pdf::loadView('admin.cetakproduk', $data);
        return $pdf->download('laporan_produk.pdf');
    }
    public function kategori()
    {
        $data['kategori'] = DB::table('kategori')->get();
        return view('admin.kategori', $data);
    }

    public function tambahkategori()
    {

        return view('admin.tambahkategori');
    }

    public function simpankategori(Request $request)
    {
        $data = [
            'namakategori' => $request->kategori,
            'idkategori' => $request->kategori,
        ];
        KategoriModel::create($data);
        session()->flash('alert', 'Berhasil menambahkan data!');
        return redirect('admin/kategori');
    }

    public function ubahkategori($id)
    {
        $data['kategori'] = KategoriModel::where('idkategori', $id)->first();
        return view('admin.ubahkategori', $data);
    }

    public function updatekategori(Request $request, $id)
    {
        $data = [
            'namakategori' => $request->kategori
        ];
        KategoriModel::where('idkategori', $id)->update($data);
        session()->flash('alert', 'Berhasil mengubah data!');
        return redirect('admin/kategori');
    }

    public function hapuskategori($id)
    {
        KategoriModel::where('idkategori', $id)->delete();
        session()->flash('alert', 'Berhasil menghapus data!');
        return redirect('admin/kategori');
    }

    public function produk()
    {
        $produk = DB::table('produk')->leftJoin('kategori', 'produk.idkategori', '=', 'kategori.idkategori')->get();
        $data['produk'] = $produk;
        return view('admin.produk', $data);
    }

    public function tambahproduk()
    {
        $data['kategori'] = DB::table('kategori')->get();

        return view('admin.tambahproduk', $data);
    }

    public function simpanproduk(Request $request)
    {
        $namafoto = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('foto'), $namafoto);

        DB::table('produk')->insert([
            'namaproduk' => $request->input('nama'),
            'idkategori' => $request->input('idkategori'),
            'hargaproduk' => $request->input('harga'),
            'fotoproduk' => $namafoto,
            'deskripsiproduk' => $request->input('deskripsi'),
            'stokproduk' => $request->input('stok'),
        ]);
        session()->flash('alert', 'Berhasil menambah data!');

        return redirect('admin/produk');
    }

    public function ubahproduk($id)
    {
        $data['produk'] = DB::table('produk')->where('idproduk', $id)->first();
        $data['kategori'] = DB::table('kategori')->get();
        return view('admin.ubahproduk', $data);
    }

    public function updateproduk(Request $request, $id)
    {
        $data = [
            'namaproduk' => $request->input('nama'),
            'idkategori' => $request->input('idkategori'),
            'hargaproduk' => $request->input('harga'),
            'deskripsiproduk' => $request->input('deskripsi'),
            'stokproduk' => $request->input('stok'),
        ];
        $produk = DB::table('produk')->where('idproduk', $id)->first();
        $fotoPath = public_path('foto/' . $produk->fotoproduk);
        if ($request->hasFile('foto')) {
            $namafoto = $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('foto'), $namafoto);
            $data = [
                'fotoproduk' => $namafoto,
            ];

            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }
        DB::table('produk')->where('idproduk', $id)->update($data);
        session()->flash('alert', 'Berhasil mengubah data!');
        return redirect('admin/produk');
    }

    public function hapusproduk($id)
    {
        DB::table('produk')->where('idproduk', $id)->delete();
        session()->flash('alert', 'Berhasil menghapus data!');
        return redirect('admin/produk');
    }

    public function hapuspengguna($id)
    {
        DB::table('pengguna')->where('id', $id)->delete();
        session()->flash('alert', 'Berhasil menghapus data!');
        return redirect('admin/pengguna');
    }

    public function pengguna()
    {
        $pengguna = DB::table('pengguna')->where('level', '<>', 'Admin')->get();

        $data = [
            'pengguna' => $pengguna,
        ];

        return view('admin.pengguna', $data);
    }

    public function logout()
    {
        session()->flush();
        return redirect('home')->with('alert', 'Anda Telah Logout');
    }

    public function pembelian()
    {
        $pembelian = DB::table('pembelian')->join('pengguna', 'pengguna.id', '=', 'pembelian.id')->where('statusbeli', '<>', 'Belum Bayar')
            ->orderBy('pembelian.tanggalbeli', 'desc')->orderBy('pembelian.idpembelian', 'desc')->get();

        $dataproduk = [];
        foreach ($pembelian as $row) {
            $idpembelian = $row->idpembelian;
            $produk = DB::table('pembelianproduk')
                ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
                ->where('idpembelian', $idpembelian)
                ->get();
            $dataproduk[$idpembelian] = $produk;
        }


        $data = [
            'pembelian' => $pembelian,
            'dataproduk' => $dataproduk,
        ];
        return view('admin.pembelian', $data);
    }

    public function pembelianhapus($id)
    {
        DB::table('pembelian')->where('idpembelian', $id)->delete();
        session()->flash('success', 'Berhasil menghapus data!');
        return redirect('admin/pembelian');
    }
    public function pembayaran($id)
    {
        $datapembelian = DB::table('pembelian')->join('pengguna', 'pengguna.id', '=', 'pembelian.id')
            ->where('pembelian.idpembelian', $id)->first();
        $dataproduk = DB::table('pembelianproduk')
            ->join('produk', 'pembelianproduk.idproduk', '=', 'produk.idproduk')
            ->where('idpembelian', $id)
            ->get();

        $pembayaran = DB::table('pembayaran')->where('idpembelian', $id)->first();

        $data = [
            'datapembelian' => $datapembelian,
            'dataproduk' => $dataproduk,
            'pembayaran' => $pembayaran,
        ];

        return view('admin.pembayaran', $data);
    }

    public function simpanpembayaran($id, Request $request)
    {
        if ($request->has('proses')) {
            $catatanadmin = $request->input('catatanadmin', false);
            $statusbeli = $request->input('statusbeli');
            DB::table('pembelian')->where('idpembelian', $id)->update([
                'catatanadmin' => $catatanadmin,
                'statusbeli' => $statusbeli,
            ]);

            if ($statusbeli == 'Selesai') {
                $dataproduk = DB::table('pembelianproduk')->where('idpembelian', $id)->get();
                foreach ($dataproduk as $p) {
                    $idproduk = $p->idproduk;
                    $jumlah = $p->jumlah;
                    DB::table('produk')->where('idproduk', $idproduk)->update([
                        'stok_produk' => DB::raw('stok_produk - ' . $jumlah),
                    ]);
                }
            }

            return redirect('admin/pembelian');
        }
    }
}
