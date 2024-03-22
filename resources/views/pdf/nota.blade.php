<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nota</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .body-table {
            max-width: 46rem;
            margin: auto;
            padding: 2rem;
            border: 1px solid #D1D5DB;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-radius: 0.5rem;
            color: #4A5568;
            font-weight: 500;
            font-size: 1rem;
            line-height: 1.5;
        }
        .table-column{
            padding-bottom: 12px;
        }

        .total .payment {
            text-align: right;
        }

        .detail-subtotal {
            background-color: #E5E7EB;
            padding: 1rem;
            font-weight: bold;
        }
    </style>
</head>
    <body>
        <div class="body-table">
            <table class="w-full text-left">
                <tbody>
                        <tr>
                            <td colspan=2 class="table-column">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <strong>Coffee Shop</strong>
                                                <br />
                                                {{$data->tanggal}}
                                                <br />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr class="total detail-subtotal">
                                <td>Produk</td>
                                <td class="payment">Subtotal</td>
                            </tr>

                            @foreach ($data->detailTransaksi as $transaksi)

                            <tr class="total">
                                <td>
                                    {{ $transaksi->menu->nama_menu}}<br />
                                    <strong>Harga :</strong>
                                    {{ $transaksi->unit_price }} x {{$transaksi->quantity}}
                                </td>
                                <td class="payment">
                                    Rp. {{$transaksi->unit_price}} {{$transaksi->quantity}}
                                </td>
                            </tr>
                            @endforeach

                            <tr class="total">
                                <td></td>
                                <td class="payment">
                                    Subtotal : Rp. {{$transaksi->total_harga}}
                                </td>
                            </tr>
                            <tr class="total">
                                <td></td>
                                <td class="payment">
                                    Pembayaran: Rp -2000 <br />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Detail Pembayaran</strong>
                                </td>
                            </tr>

                            <tr>
                                <td>Transfer ke: {transaksi.id}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tanggal: {transaksi.tanggal}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
</body>
</html>
