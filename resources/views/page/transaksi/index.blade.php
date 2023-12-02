@extends('layouts.base_admin.base_dashboard') 
@section('css')
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tabel Transaksi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Tabel Transaksi</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    @if(session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        {{ session('status') }}
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pembeli</th>
                            <th>Kode Transaksi</th>
                            <th>Detail Barang</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no_transaksi = 1; ?>
                        @foreach ($transaksis as $transaksi)
                            <tr>
                                <td>{{ $no_transaksi++ }}</td>
                                <td>{{ $transaksi->user->name }}</td>
                                <td>{{ $transaksi->transaksi_code }}</td>
                                <td>
                                    <ol>
                                        @forelse($transaksi->items as $item)
                                            <li>
                                                {{ $item->nama }} ({{ $item->quantity }})
                                            </li>
                                        @empty
                                            <li>No items</li>
                                        @endforelse
                                    </ol>
                                </td>
                                <td>Rp. {{ number_format($transaksi->total_harga) }}</td>
                                <td>{{ $transaksi->tanggal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
