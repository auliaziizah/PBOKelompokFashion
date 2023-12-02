<!-- resources/views/transaksi/tambah_transaksi.blade.php -->
@extends('layouts.base_admin.base_dashboard') 
@section('css')
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Transaksi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Transaksi</li>
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('transaksi.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="id_daftar">Daftar Pakaian</label>
                                        <select class="form-control" id="id_daftar">
                                            @foreach($barangs as $barang)
                                                @if($barang->stok > 0)
                                                    <option value="{{$barang->id_daftar}}"
                                                            data-id="{{$barang->id}}"
                                                            data-nama_barang="{{$barang->nama_barang}}"
                                                            data-harga="{{$barang->harga}}">
                                                        {{$barang->nama_barang}} Rp. {{number_format($barang->harga)}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <button type="button" class="btn btn-primary d-block" onclick="tambahItem()">Tambah Item</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-hover tabel-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Quantity</th>
                                                <th>Harga</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody class="transaksiItem">
                                             
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Jumlah</th>
                                                <th class="quantity">0</th>
                                                <th class="totalHarga">0</th>
                                                <th class="jumlahUang">0</th>
                                                <th class="kembalian">0</th>
                                                <th class="action"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jumlah_uang">Jumlah Uang</label>
                                        <input type="text" class="form-control" id="jumlah_uang" name="jumlah_uang" placeholder="Masukkan Jumlah Uang" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="total_harga" value="0">
                                    <input type="hidden" name="jumlah_uang" id="jumlah_uang_hidden" value="">
                                    <input type="hidden" name="kembalian" id="kembalian_hidden" value="">
                                    <button class="btn btn-success" onclick="bayar()">Bayar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var listItem = [];
    var totalHarga = 0;
    var quantity = 0;
    var jumlahUang = 0;
    var kembalian = 0;

    function number_format(number, decimals, dec_point, thousands_sep) {
        // Format angka dengan memisahkan ribuan dan desimal
        // number: Angka yang akan diformat
        // decimals: Jumlah desimal (opsional, default: 2)
        // dec_point: Pemisah desimal (opsional, default: '.')
        // thousands_sep: Pemisah ribuan (opsional, default: ',')

        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        decimals = decimals || 2;
        dec_point = dec_point || '.';
        thousands_sep = thousands_sep || ',';

        var sign = number < 0 ? '-' : '';
        var i = parseInt(number = Math.abs(+number || 0).toFixed(decimals)) + '';
        var j = (j = i.length) > 3 ? j % 3 : 0;

        return (
            sign +
            (j ? i.substr(0, j) + thousands_sep : '') +
            i.substr(j).replace(/(\d{3})(?=\d)/g, '$1' + thousands_sep) +
            (decimals
                ? dec_point +
                Math.abs(number - i)
                    .toFixed(decimals)
                    .slice(2)
                : '')
        );
    }

    function tambahItem() {
        var selectedId = $('#id_daftar').find(':selected').data('id');
        var nama = $('#id_daftar').find(':selected').data('nama_barang');
        var harga = parseFloat($('#id_daftar').find(':selected').data('harga').replace(/[^\d.-]/g, ''));

        var existingItem = listItem.find(item => item.id === selectedId);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            var newItem = {
                id: selectedId,
                nama: nama,
                harga: harga,
                quantity: 1,
            };
            listItem.push(newItem);
        }

        updateQuantity(1);
        updateTotalHarga(harga);
        updateJumlahUang(0);
        updateKembalian(0);
        updateTable();
    }

    function updateTable() {
        var html = '';
        listItem.map((el, index) => {
            var hargaFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(el.harga);
            var quantityFormatted = new Intl.NumberFormat('id-ID').format(el.quantity);
            
            html += `
            <tr>
                <td>${index + 1}</td>
                <td>${el.nama}</td>
                <td>${quantityFormatted}</td>
                <td>${hargaFormatted}</td>
                <td>
                    <input type="hidden" name="id_daftar[]" value="${el.id}">
                    <input type="hidden" name="quantity[]" value="${el.quantity}">
                    <button type="button" onclick="deleteItem(${index})" class="btn btn-link">
                        <i class="fas fa-fw fa-trash text-danger"></i>
                    </button>
                </td>
            </tr>
            `;
        });
        $('.transaksiItem').html(html);

        updateTotalHarga(0);
        updateQuantity(0);
        updateJumlahUang(0);
        updateKembalian(0);
    }

    function deleteItem(index) {
        var item = listItem[index];
        if (item.quantity > 1) {
            listItem[index].quantity -= 1;
            updateTotalHarga(-(item.harga));
            updateQuantity(-1);
        } else {
            listItem.splice(index, 1);
            updateTotalHarga(-(item.harga * item.quantity));
            updateQuantity(-(item.quantity));
        }
        updateJumlahUang(0);
        updateKembalian(0);
        updateTable();
    }

    function updateTotalHarga(nom) {
        totalHarga += nom;
        $('[name=total_harga]').val(totalHarga);
        $('.totalHarga').html(number_format(totalHarga.toString()));
    }

    function updateQuantity(nom) {
        quantity += nom;
        $('.quantity').html(quantity.toString());
    }

    function updateJumlahUang(nom) {
        jumlahUang += nom;
        $('.jumlahUang').html(number_format(jumlahUang.toString()));
    }

    function updateKembalian(nom) {
        kembalian = jumlahUang - totalHarga;
        $('.kembalian').html(number_format(kembalian.toString()));
    }

    function bayar() {
        var jumlahUangInput = parseInt($('#jumlah_uang').val().replace(/[^\d]/g, '')) || 0;
        updateJumlahUang(jumlahUangInput);
        updateKembalian(0);

        if (jumlahUangInput >= totalHarga) {
            var kembalian = jumlahUangInput - totalHarga;
            updateKembalian(kembalian);

            // Set the values of 'jumlah_uang' and 'kembalian' to the hidden fields
            $('#jumlah_uang_hidden').val(jumlahUangInput);
            $('#kembalian_hidden').val(kembalian);

            // Submit the form
            $('#transaksiForm').submit();
        } else {
            // Show an alert if 'Jumlah Uang' is less than 'Total Harga'
            alert("Jumlah Uang harus lebih besar atau sama dengan Total Harga");
        }
    }
    </script>
@endsection
