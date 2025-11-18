<!-- @dump($data) Ini akan dump variabel $name tanpa menghentikan eksekusi -->
@extends('layouts.app')

@section('title', 'Data Transaksi Penjualan')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Tutorial Laravel 11 - Transaksi</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('transaksi_penjualan.create') }}" class="btn btn-md btn-success mb-3">ADD TRANSACTION</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Nama Kasir</th>
                                    <th scope="col">Email Pembeli</th>
                                    <th scope="col" style="width: 10%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $transaksi)
                                    <tr>
                                        <td>{{ date('d M Y H:i:s', strtotime($transaksi->tanggal_transaksi)) }}</td>
                                        <td>{{ $transaksi->nama_kasir }}</td>
                                        <td>{{ $transaksi->email_pembeli }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksi_penjualan.destroy', $transaksi->id) }}" method="POST">
                                                <a href="{{ route('transaksi_penjualan.show', $transaksi->id) }}" class="btn btn-sm btn-dark m-1">SHOW</a>
                                                <a href="{{ route('transaksi_penjualan.edit', $transaksi->id) }}" class="btn btn-sm btn-primary m-1">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger m-1">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Transaksi belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

    </script>
@endsection