<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Invoice</title>
    <style>
        @import url('http://fonts.cdnfonts.com/css/vcr-osd-mono');

        body {
            font-family: 'VCR OSD Mono';
            color: #000;
            text-align: center;
            display: flex;
            justify-content: center;
            font-size: 16px;
            padding-top: 50px;
        }

        .bill {
            width: 350px;
            box-shadow: 0 0 3px #aaa;
            padding: 10px 10px;
            box-sizing: border-box;
        }

        .flex {
            display: flex;
        }

        .justify-between {
            justify-content: space-between;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table .header {
            border-top: 2px dashed #000;
            border-bottom: 2px dashed #000;
        }

        .table {
            text-align: left;
        }

        .table .total td:first-of-type {
            border-top: none;
            border-bottom: none;
        }

        .table .total td {
            border-top: 2px dashed #000;
            border-bottom: 2px dashed #000;
        }

        .table .net-amount td:first-of-type {
            border-top: none;
        }

        .table .net-amount {
            border-bottom: 2px dashed #000;
        }

        @media print {
            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="bill">
        <div class="brand">
            WIKUSAMA CAFE
        </div>
        <div class="address">
            Jalan Kita Masih Panjang No. 69 <br> No. Tel 08123456789
        </div>
        <div class="shop-details">

        </div>
        <div class="bill-details" style="margin: 10px 0 10px 0">
            <div class="flex justify-between">
                <div>No. Meja: {{ $transaction->table->number ?? '-' }}</div>
            </div>
            <div class="flex justify-between">
                <div>Tanggal/Waktu: {{ $transaction->updated_at->format('d M Y  H:i')}}</div>
            </div>
        </div>
        <table class="table">
            <tr class="header">
                <th>
                    Menu
                </th>
                <th>
                    Harga
                </th>
                <th>
                    Qty
                </th>
                <th>
                    Subtotal
                </th>
            </tr>
            @foreach ($transaction->orders as $order)
                <tr>
                    <td>{{ mb_strimwidth($order->menu->name, 0, 20, '...') }}</td>
                    <td>{{ number_format($order->menu->price, 0, ',', '.') }}</td>
                    <td>{{ $order->qty }}</td>
                    <td>{{ number_format($order->menu->price * $order->qty, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total">
                <td></td>
                <td>Total</td>
                <td>
                    {{ $transaction->orders->sum('qty') }}
                </td>
                <td>{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tunai</td>
                <td></td>
                <td>{{ number_format($transaction->total_payment, 0, ',', '.') }}</td>
            </tr>
            <tr class="net-amount">
                <td></td>
                <td>Kembali</td>
                <td></td>
                <td>{{ number_format($transaction->total_payment - $transaction->total_price, 0, ',', '.') }}</td>
            </tr>
        </table>
        <div style="margin-top: 6px">
            Kasir: {{ $transaction->cashier->name ?? '-' }}<br>
            Customer: {{ $transaction->customer_name ?? '-' }}<br>
            Terima kasih!
        </div>
    </div>
</body>

</html>
