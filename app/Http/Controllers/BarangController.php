<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DataTables;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Barang::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="'.route('barang.hapusdata', ['id' => $row->id]).'" class="btn btn-danger">Delete</a>
                            <a href="'.route('barang.updatedata', ['id' => $row->id]).'" class="btn btn-info">Edit</a>';
                return $actionBtn;

                })
                ->rawColumns(['action'])
                ->make(true);
        }


        if ($request->hasFile('image')) {
            $request->file('image')->move('fotoprofil/', $request->file('image')->getClientOriginalName());
            $data->image = $request->file('image')->getClientOriginalName();
            $data->save();
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fotoprofil', 'public');
        }

        return view('page.barang.tabelbarang');
    }

    public function tambahdatabarang(){
        return view('page.barang.databarang');
    }

    public function insertdata(Request $request){
        try {
            $data = Barang::create($request->all());
            $dataId = $data->id;
            return redirect()->route('barang.tambahdatabarang', ['id' => $dataId])->with('success', 'Data Berhasil di Simpan');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan data: ' . $e->getMessage());
            return redirect()->route('barang.tambahdatabarang')->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
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
        return view('page.barang.updatedatabarang', compact('data'));
    }

    public function editdata(Request $request, $id){
        try {
            $data = Barang::find($id);
            $data->update($request->all());
            return redirect()->route('barang.tambahdatabarang')->with('success', 'Data berhasil di update');
        } catch (\Exception $e) {
            Log::error('Gagal mengupdate data: ' . $e->getMessage());
            return redirect()->route('barang.tambahdatabarang')->with('error', 'Terjadi kesalahan saat mengupdate data');
        }
    }

    public function hapusdata(Request $request, $id) {
        try {
            Barang::destroy($id);
            return redirect()->route('barang.index')->with('flash_message', 'Item dihapus');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus data: ' . $e->getMessage());
            return redirect()->route('barang.index')->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}