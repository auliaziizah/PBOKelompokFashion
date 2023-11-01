<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Data Barang</title>
</head>

<body>
  @extends('layouts.main')
  @section('container')

  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif

  <h1 class="text-center mb-4">Edit Data Barang</h1>
  <div class="container">
    <div class="row just1ify-content-center">
      <div class="col-8">
        <div class="card">
          <div class="card-body">
            <form action="/editdata/{{ $data->id }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $data->nama_barang }}">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $data->harga }}">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Ukuran</label>
                <input type="text" name="ukuran" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $data->ukuran }}">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Status</label>
                <input type="text" name="status" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $data->status }}">
              </div>
              <button class="btn btn-info" type="submit">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>