<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(){
        $data = Barang::all();
        return view('page.barang.tabelbarang', compact('data'));
    }
    public function tambahdatabarang(){
        return view('page.barang.databarang');
    }

    public function insertdata(Request $request){
        $data = Barang::create($request->all());
        
        // Mengambil ID pengguna yang baru saja dibuat
        $dataId = $data->id;
        return redirect()->route('barang.tambahdatabarang', ['id' => $dataId])->with('success', 'Data Berhasil di Simpan');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'nama_barang' => 'required|string',
            'harga' => 'required|numeric',
            'ukuran' => 'required|string',
            'bahan' => 'required|string',
            'brand' => 'required|string',
            'stok' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        // Simpan data baru ke dalam database menggunakan model
        Barang::create($validatedData);

        // Redirect ke halaman yang sesuai setelah data berhasil disimpan
        return redirect()->route('page.barang.tabelbarang');
    }

    public function updatedata($id){

        $data = Barang::find($id);
        //dd($data);
        return view('page.barang.updatedatabarang', compact('data'));
    }

    public function editdata(Request $request, $id){

        $data = Barang::find($id);
        //dd($data);
        $data->update($request->all());
        return redirect()->route('barang.tambahdatabarang')->with('success', 'Data berhasil di update');

    }

    public function hapusdata(Request $request, $id) {
        Barang::destroy($id);
        return redirect('lihatbarang')->with('flash_message', 'Item deleted');
    }
}