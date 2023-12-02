<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class BarangExport implements FromCollection, WithHeadings, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Barang::select('id', 'nama_barang', 'harga', 'ukuran', 'bahan', 'brand', 'stok', 'deskripsi')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return ["ID", "NAMA_BARANG", "HARGA", "UKURAN", "BAHAN", "BRAND", "STOK", "DESKRIPSI"];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5, // Lebar kolom A
            'B' => 30, // Lebar kolom B
            'C' => 10, // Lebar kolom C
            'D' => 10, // Lebar kolom D
            'E' => 10, // Lebar kolom E
            'F' => 10, // Lebar kolom F
            'G' => 10, // Lebar kolom G
            'H' => 20, // Lebar kolom H
        ];
    }
}
