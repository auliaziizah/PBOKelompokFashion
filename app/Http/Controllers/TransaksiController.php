<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::latest('tanggal')->get();
        $transaksis = Transaksi::with('items')->get();
        return view('page.transaksi.index', ['transaksis' => $transaksis]);
    }


    public function create(){
        $barangs = Barang::all();
        return view('page.transaksi.create', ['barangs' => $barangs]);
    }

    public function store(Request $request)
    {
        $transaksi = new Transaksi();
        $transaksis = Transaksi::with('user')->get();
        $transaksi->timestamps = false; 
        $transaksi->fill([
            'tanggal' => now(),
            'user_id' => Auth::id(),
            'total_harga' => $request->get('total_harga'),
            'jumlah_uang' => $request->input('jumlah_uang'),
            'kembalian' => $request->input('kembalian'),
        ]);
        $transaksi->save();

        $no_daftar = 0;
        foreach ($request->get('id_daftar') as $id_daftar) {
            $barang = Barang::findOrFail($id_daftar);

            // Check if $barang is not null before proceeding
            if ($barang !== null) {
                // Create a new TransaksiItem
                $transaksi_item = new TransaksiItem();
                $transaksi_item->fill([
                    'id_transaksi' => $transaksi->id,
                    'id_pakaian' => $barang->id,
                    'nama' => $barang->nama_barang,
                    'harga' => $barang->harga,
                    'quantity' => $request->get('quantity')[$no_daftar]
                ]);
                $transaksi_item->save();

                // Update the product's stock
                $newStock = $barang->stok - $request->get('quantity')[$no_daftar];
                $barang->update(['stok' => $newStock]);
            } else {
                // Log an error (adjust the log level and message as needed)
                Log::error("Product with ID $id_daftar not found");
            }

            $no_daftar++;
        }

        $transaksis = Transaksi::with('items')->get();
        return redirect()->route('transaksi.list', ['transaksis' => $transaksis]);
    }

    public function list()
    {
        // Fetch all transactions with their associated items
        $transaksis = Transaksi::with('items')->get();

        // Return the view with the transactions data
        return view('page.transaksi.list' , ['transaksis' => $transaksis]);
    }

    public function download()
    {
        $latestTransaksi = Transaksi::with('items')
        ->orderBy('tanggal', 'desc')
        ->first();

        // Create a new instance of PhpWord
        $phpWord = new PhpWord();

        // Add content to the PhpWord document based on the latest transaction
        $section = $phpWord->addSection();
        $section->addText('ClothChic', array('bold' => true, 'size' => 16, 'align' => 'center'));
        $section->addText("$latestTransaksi->transaksi_code");
        $section->addText('-------------------------------------------------------------------------------------------------------------');

        // Add a table for transaction items
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(3500)->addText('Nama');
        $table->addCell(2500)->addText('Quantity');
        $table->addCell(3000)->addText('Price');
        $table->addCell(3500)->addText('Total');
        foreach ($latestTransaksi->items as $item) {
            $table->addRow();
            $table->addCell(3500)->addText($item->nama);
            $table->addCell(2500)->addText($item->quantity);
            $table->addCell(3000)->addText(number_format($item->harga));
            $table->addCell(3500)->addText(number_format($item->quantity * $item->harga));
        }
        $section->addText('-------------------------------------------------------------------------------------------------------------');
        $section->addText("Total Purchase: Rp. " . number_format($latestTransaksi->total_harga));
        $section->addText("Amount Paid: Rp. " . number_format($latestTransaksi->jumlah_uang));
        $section->addText("Change: Rp. " . number_format($latestTransaksi->kembalian));

        // Save the Word document
        $writer = new Word2007($phpWord);
        $filename = 'transaction.docx';
        $filePath = storage_path("app/public/{$filename}");
        $writer->save($filePath);

        // Provide the file for download
        return response()->download($filePath, $filename);
    }
}