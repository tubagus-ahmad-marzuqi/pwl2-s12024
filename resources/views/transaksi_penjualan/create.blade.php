<!-- @dump($data) -->
@extends('layouts.app')

@section('title', 'Data Tambah Transaksi')

@section('content')

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Tambah Transaksi</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form id="transaksiForm" action="{{ route('transaksi_penjualan.store') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Nama Kasir</label>
                                <input type="text" class="form-control @error('nama_kasir') is-invalid @enderror" name="nama_kasir" placeholder="Masukkan Nama Kasir">
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Email Pembeli</label>
                                <input type="email" class="form-control @error('email_pembeli') is-invalid @enderror" name="email_pembeli"  placeholder="Masukkan Email Pembeli">
                            </div>

                            <hr>
                            <button type="button" class="btn btn-success mt-3" id="add_item_btn">Add Item</button>
                            <hr>

                            <table>
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Jumlah Pembelian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="item_details">
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-md btn-primary my-3 me-3">SAVE</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );

        function resetForm() {
            document.getElementById("transaksiForm").reset(); // Mereset semua nilai dalam form

            // Reset CKEditor content to empty
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData('');  // Reset CKEditor content
            }
        }

        // let itemIndex = 1;

        document.getElementById('add_item_btn').addEventListener('click', function() {
            const table = document.getElementById('item_details');
            const newRow = table.insertRow();

            newRow.innerHTML = `
                <td>
                    <select class="form-control" name="id_product[]" required>
                        <option value="">-- Select Product --</option>
                        @foreach ($data['products'] as $product)
                            <option value="{{ $product->id }}">{{ $product->product_category_name }} - {{ $product->title }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="jumlah_pembelian[]" class="form-control" required /></td>
                <td><button type="button" class="btn btn-danger my-1" onclick="removeRow(this)">Remove</button></td>
            `;
            // itemIndex++;
        });

        function removeRow(button) {
            button.closest('tr').remove();
        }

        function resetForm() {
            document.getElementById("transactionForm").reset();
        }
    </script>
@endsection