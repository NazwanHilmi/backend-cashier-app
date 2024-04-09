<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nota</title>
    <style>
        body {
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 32rem; /* max-w-lg */
            margin-left: auto;
            margin-right: auto;
            padding: 2rem; /* p-8 */
            border: 1px solid #e5e7eb; /* border border-gray-300 */
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); /* shadow-lg */
            border-radius: 0.5rem; /* rounded-lg */
        }
        .table {
            width: 100%; /* w-full */
            text-align: left; /* text-left */
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
        <div class="container">
            <table class="table">
                <tbody>
                        <tr>
                            <td colspan=2 class="table-column">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <strong>Coffee Shop</strong>
                                                <br />
                                                {{ str_replace('-', '', $data->tanggal) }}000{{ $data->id }}
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
                                <td class="payment" id="hargaTotal">
                                    Rp. {{ $transaksi->unit_price * $transaksi->quantity}}
                                </td>
                            </tr>
                            @endforeach

                            <tr class="total">
                                <td></td>
                                <td class="payment">
                                    Subtotal : Rp. {{$data->total_harga}}
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
                                <td>Transfer ke: {{$data->id}}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tanggal: {{$data->tanggal}}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
</body>
</html>
