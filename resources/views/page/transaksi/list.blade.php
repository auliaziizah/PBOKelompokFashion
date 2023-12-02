<!-- resources/views/transaksi/list_transaksi.blade.php -->
@extends('layouts.base_admin.base_dashboard') 

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        </div>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="card">
                    <div class="card-body ">
                        <h2 class="text-center">ClothChic</h2>

                        {{-- Retrieve the latest transaction from the collection --}}
                        @php
                            $latestTransaction = $transaksis->last();
                        @endphp

                        <div class="transaction-details">
                            <p class="text-center">{{ $latestTransaction->transaksi_code }}</p>
                            <p class="text-center">-----------------------------------------------------------------------------------</p>
                            <table>
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 35%;">Nama</th>
                                        <th style="width: 25%;">Quantity</th>
                                        <th style="width: 30%;">Price</th>
                                        <th style="width: 35%;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestTransaction->items as $index => $item)
                                        <tr class="text-center">
                                            <td style="width: 35%;">{{ $item->nama }}</td>
                                            <td style="width: 25%;">{{ $item->quantity }}</td>
                                            <td style="width: 30%;">{{ number_format($item->harga) }}</td>
                                            <td style="width: 35%;">{{ number_format($item->quantity * $item->harga) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Display total, amount paid, and change -->
                            <p class="text-center">-----------------------------------------------------------------------------------</p>
                            <div class="total-section">
                                <p>Total Purchase: Rp. {{ number_format($latestTransaction->total_harga) }}</p>
                                <p>Amount Paid: Rp. {{ number_format($latestTransaction->jumlah_uang) }}</p>
                                <p>Change: Rp. {{ number_format($latestTransaction->kembalian) }}</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('transaksi.download') }}" class="btn btn-primary">Download as Word</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
