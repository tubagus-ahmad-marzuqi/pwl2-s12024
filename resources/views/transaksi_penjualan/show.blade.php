@extends('layouts.app')

@section('title', 'Data Detail Transaksi')

@section('content')
<div class="container mt-5 mb-5">
        <div class="row">
            <h3>Detail Transaksi</h3>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h4>Nama Kasir: {{ $data[0]->nama_kasir }}</h4>
                        <hr>
                        <p><strong>Tanggal Transaksi:</strong> {{ $data[0]->tanggal_transaksi }}</p>
                    </div>
                </div>

                @foreach ($data as $product)
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <p><strong>Nama Produk:</strong> {{ $product['product_name'] }}</p>
                        <hr>
                        <p><strong>Kategori Produk:</strong> {{ $product['product_category_name'] }}</p>
                        <hr>
                        <p><strong>Harga:</strong> <code>RP {{ number_format($product['price'], 2, ',', '.') }}</code></p>
                        <hr>
                        <p><strong>Jumlah Pembelian:</strong> {{ $product['jumlah_pembelian'] }}</p>
                        <hr>
                        <p><strong>Total harga:</strong> RP {{ number_format($product['total_harga'], 2, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <p><strong>Total Harga:</strong></p>
                        <p><code>RP {{ number_format($total_harga['transaksi'], 2, ',', '.') }}</code></p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <p><strong>Catatan:</strong></p>
                        <p>Anda dapat menghubungi admin jika ada pertanyaan lebih lanjut mengenai transaksi ini.</p>
                        <a href="{{ route('transaksi_penjualan.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection