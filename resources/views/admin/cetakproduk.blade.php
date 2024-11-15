<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Laporan Data Produk</title>
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
    </style>
</head>
<body>
    <div>
        <h1 style="text-align: center;">Laporan Data Produk</h1>
        <h2 style="text-align: center;">PT.Lazuard Agritech</h2>
        <h3 style="text-align: center;">Tanggal {{ $tanggalHariIni }}</h3>
        <table>
                        <thead>
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">Nama</th>
                                <th style="text-align: center;">Kategori</th>
                                <th style="text-align: center;">Harga</th>
                                <th style="text-align: center;">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            @foreach ($produk as $p)
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td>{{ $p->namaproduk }}</td>
                                    <td>{{ $p->namakategori }}</td>
                                    <td>Rp. {{ $p->hargaproduk }}</td>
                                    <td>{{ $p->stokproduk }}</td>
                                </tr>
                                <?php $nomor++; ?>
                            @endforeach
                        </tbody>
                    </table>
    </div>
</body>
</html>
