@extends('layouts.base_admin.base_dashboard')

@section('judul', 'Update Data Pakaian')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Data Pakaian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">Update Data Pakaian</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('barang.editdata', ['id' => $data->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <div class="card-tools">
                                <button
                                    type="button"
                                    class="btn btn-tool"
                                    data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" placeholder="Masukkan Nama Pakaian" required value="{{ $data->nama_barang }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Brand</label>
                                <input type="text" name="brand" class="form-control" placeholder="Masukkan Nama Brand" required value="{{ $data->brand }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Bahan</label>
                                <input type="text" name="bahan" class="form-control" placeholder="Masukkan Jenis Bahan" required value="{{ $data->bahan }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" style="height: 100px;" placeholder="Masukkan Deskripsi Pakaian" required>{{ $data->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <div class="card-tools">
                                <button
                                    type="button"
                                    class="btn btn-tool"
                                    data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleSelect" class="form-label">Ukuran</label>
                                <select name="ukuran" class="form-control" id="exampleSelect">
                                    <option value="" disabled selected>Pilih Ukuran Pakaian</option>
                                    <option value="XS" {{ $data->ukuran == 'XS' ? 'selected' : '' }}>XS</option>
                                    <option value="S" {{ $data->ukuran == 'S' ? 'selected' : '' }}>S</option>
                                    <option value="M" {{ $data->ukuran == 'M' ? 'selected' : '' }}>M</option>
                                    <option value="L" {{ $data->ukuran == 'L' ? 'selected' : '' }}>L</option>
                                    <option value="XL" {{ $data->ukuran == 'XL' ? 'selected' : '' }}>XL</option>
                                    <option value="XXL" {{ $data->ukuran == 'XXL' ? 'selected' : '' }}>XXL</option>
                                    <option value="XXXL" {{ $data->ukuran == 'XXXL' ? 'selected' : '' }}>XXXL</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" min="0" placeholder="Masukkan Jumlah Stok" required value="{{ $data->stok }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Harga</label>
                                <input type="number" name="harga" class="form-control" min="0" placeholder="Masukkan Harga Pakaian" required value="{{ $data->harga }}">
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
