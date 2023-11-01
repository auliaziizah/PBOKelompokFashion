<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(){
        $data = Barang::all();
        return view('barang.tabelbarang', compact('data'));
    }
    public function tambahdatabarang(){
        return view('barang.databarang');
    }

    public function insertdata(Request $request){
        $data = Barang::create($request->all());
        
        // Mengambil ID pengguna yang baru saja dibuat
        $dataId = $data->id;
        return redirect()->route('tambahdatabarang', ['id' => $dataId])->with('success', 'Data Berhasil di Simpan');
    }

    public function updatedata($id){

        $data = Barang::find($id);
        //dd($data);
        return view('barang.updatedatabarang', compact('data'));

    }

    public function editdata(Request $request, $id){

        $data = Barang::find($id);
        //dd($data);
        $data->update($request->all());
        return redirect()->route('tambahdatabarang')->with('success', 'Data berhasil di update');

    }
    


}