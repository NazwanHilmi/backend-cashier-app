<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produk Titipan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }
        .container {
            width: 100vw;
            padding: 50px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }

        h1 {
            margin-bottom: 10px;
        }

        .content {
            width: 100%;
            color: #000;
        }

        table {
            width: 100%;
            border: 1px solid #000;
        }

        table tr {
            border: 1px solid #000;
        }

        table tr td, table tr th {
            border: 1px solid #000;
            padding: 5px;
            font-size: .7rem;
        }

        .center {
            text-align: center;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Daftar Transaksi</h1>
    </div>
    <div class="content">
        <table cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Pembayaran</th>
                <th>Note</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $transaksi)
                <tr>
                    <th>{{ $loop->index + 1 }}</th>
                    <td class='center'>{{ $transaksi->tanggal }}</td>
                    <td class='center'>{{ $transaksi->total_harga }}</td>
                    <td class='center'>{{ $transaksi->paymentMethod->name }}</td>
                    <td class='center'>{{ $transaksi->note }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
