<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pesanan Dibayar</title>
</head>
<body style="background-color:#f8f9fa;padding:20px;font-family:Arial,Helvetica,sans-serif">

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0"
                   style="background:#ffffff;border-radius:8px;padding:24px">

                <!-- Header -->
                <tr>
                    <td style="font-size:20px;font-weight:bold;padding-bottom:16px">
                        Halo, {{ $order->user->name }}
                    </td>
                </tr>

                <!-- Message -->
                <tr>
                    <td style="font-size:14px;color:#333;padding-bottom:16px">
                        Terima kasih! Pembayaran untuk pesanan
                        <strong>#{{ $order->order_number }}</strong> telah kami terima.
                        Kami sedang memproses pesanan Anda.
                    </td>
                </tr>

                <!-- Table -->
                <tr>
                    <td>
                        <table width="100%" cellpadding="8" cellspacing="0"
                               style="border-collapse:collapse;font-size:14px">

                            <thead>
                            <tr style="background:#f1f3f5">
                                <th align="left" style="border:1px solid #dee2e6">Produk</th>
                                <th align="center" style="border:1px solid #dee2e6">Qty</th>
                                <th align="right" style="border:1px solid #dee2e6">Harga</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td style="border:1px solid #dee2e6">
                                        {{ $item->product_name }}
                                    </td>
                                    <td align="center" style="border:1px solid #dee2e6">
                                        {{ $item->quantity }}
                                    </td>
                                    <td align="right" style="border:1px solid #dee2e6">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" align="right"
                                    style="border:1px solid #dee2e6;font-weight:bold">
                                    Total
                                </td>
                                <td align="right"
                                    style="border:1px solid #dee2e6;font-weight:bold">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </td>
                </tr>

                <!-- Button -->
                <tr>
                    <td align="center" style="padding:24px 0">
                        <a href="{{ route('orders.show', $order) }}"
                           style="
                           background:#0d6efd;
                           color:#ffffff;
                           padding:12px 20px;
                           text-decoration:none;
                           border-radius:6px;
                           display:inline-block;
                           font-weight:bold;
                           ">
                            Lihat Detail Pesanan
                        </a>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="font-size:13px;color:#6c757d">
                        Jika ada pertanyaan, silakan balas email ini.
                        <br><br>
                        Salam,<br>
                        <strong>{{ config('app.name') }}</strong>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
