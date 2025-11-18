<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi Anda</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f8fafc;
            color: #334155;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #ffffff;
            max-width: 700px;
            margin: 0 auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }
        h3 {
            text-align: center;
            color: #1e293b;
            margin-bottom: 10px;
        }
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: #f9fafb;
        }
        .card h4 {
            margin: 0;
            color: #0f172a;
        }
        .card p {
            margin: 6px 0;
        }
        hr {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 10px 0;
        }
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #1e293b;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 13px;
            color: #64748b;
        }
        .btn {
            display: inline-block;
            padding: 10px 16px;
            background-color: #3b82f6;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 15px;
        }
        .btn:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>🧾 Detail Transaksi Anda</h3>
        <hr>

        <div class="card">
            <h4>Nama Kasir: {{ $data[0]->nama_kasir }}</h4>
            <p><strong>Tanggal Transaksi:</strong> {{ $data[0]->tanggal_transaksi }}</p>
        </div>

        @foreach ($data as $product)
        <div class="card">
            <p><strong>Nama Produk:</strong> {{ $product['product_name'] }}</p>
            <p><strong>Kategori Produk:</strong> {{ $product['product_category_name'] }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($product['price'], 2, ',', '.') }}</p>
            <p><strong>Jumlah Pembelian:</strong> {{ $product['jumlah_pembelian'] }}</p>
            <hr>
            <p><strong>Total Harga:</strong> Rp {{ number_format($product['total_harga'], 2, ',', '.') }}</p>
        </div>
        @endforeach

        <div class="total">
            Total Transaksi: Rp {{ number_format($total_harga['transaksi'], 2, ',', '.') }}
        </div>

        <div class="footer">
            <p>Terima kasih telah berbelanja bersama kami!</p>
            <p>Jika ada pertanyaan lebih lanjut, silakan hubungi admin melalui email ini.</p>
            <a href="{{ route('transaksi_penjualan.index') }}" class="btn">Lihat Transaksi Lain</a>
        </div>
    </div>
</body>
</html>
