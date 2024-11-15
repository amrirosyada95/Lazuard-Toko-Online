<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: black;
        }
        h1 {
            text-align: center;
            color: black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #B7B7B7;
        }
        tr:nth-child(even) {
            background-color: #B7B7B7;
        }
        td {
            font-size: 12px;
        }
        .signature-table {
            width: 100%;
            margin-top: 30px;
            border: none;
        }
        .signature-table td {
            border: none; /* Menghilangkan border di tabel tanda tangan */
        }
        .signature {
            text-align: right;
            padding-right: 50px;
        }
        .signature img {
            width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <div>
        <h1 style="text-align: center;">Laporan Transaksi</h1>
        <h2 style="text-align: center;">PT. Lazuard Agritech</h2>
        <h3 style="text-align: center;">Tanggal {{ $tanggal_mulai }} - {{ $tanggal_selesai }}</h3>
        <h3 style="text-align: center;">Total Pembelian: Rp. {{ number_format($laporan->sum('totalbeli') + $laporan->sum('ongkir')) }}</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Daftar</th>
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
    <table class="signature-table">
        <tr>
            <td></td>
            <td class="signature">
                Mengetahui,<br>
                Admin Toko<br><br><br><br>
                <em><strong><u>Amri Rosyada</u></strong></em>
            </td>
        </tr>
    </table>
    
</body>
</html>
