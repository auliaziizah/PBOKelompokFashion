@extends('layouts.base_admin.base_dashboard')@section('judul', 'List Akun')
@section('script_head')
<link
    rel="stylesheet"
    type="text/css"    
    link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"
    link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Tambahkan CSS khusus untuk mengatur search bar dan pagination */
        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: left;
        }

        .dataTables_wrapper .dataTables_paginate {
            float: right;
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Barang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Akun</li>
                </ol>
            </div>
        </div>
    </div>
</a>
</section>

<section class="content">
<div class="mb-3"><a class="btn btn-primary" href="{{ route('barang.export') }}">Download</a>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-tools">
                <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="collapse"
                    title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="remove"
                    title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0" style="margin: 20px">
            <table
                id="barang"
                class="table table-bordered yajra-datatable"
                style="width:100%">
                <thead>
                    <tr>
                        <th scope="col" class="no-sort">No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Ukuran</th>
                        <th scope="col">Bahan</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col" class="no-sort">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</section>
@endsection @section('script_footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
    $('#barang').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('barang.lihatbarang') }}",
            type: 'GET'
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%' },
            { data: 'nama_barang', name: 'nama_barang', width: '12%' },
            { data: 'harga', name: 'harga', width: '10%' },
            { data: 'ukuran', name: 'ukuran', width: '5%' },
            { data: 'bahan', name: 'bahan', width: '10%' },
            { data: 'brand', name: 'brand', width: '10%' },
            { data: 'stok', name: 'stok', width: '8%' },
            { data: 'deskripsi', name: 'deskripsi', width: '20%' },
            { data: 'action', name: 'action', width: '13%' }
        ],
        "order": [],
        "columnDefs": [
            { "orderable": false, "targets": $('.no-sort') }
        ],
        "initComplete": function(settings, json) {
            // Menambahkan ikon sorting pada kolom yang bisa diurutkan
            $('#barang thead th:not(.no-sort)').each(function() {
                $(this).append('<span style="float:right;"><i class="fas fa-sort"></i></span>');
            });
        }
    });
});
</script>
@endsection