<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportBarang implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Barang::orderBy('nama_barang', 'asc')->get();

        return $data;
        
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Barang',
            'Harga',
            'Ukuran',
            'Bahan',
            'Brand',
            'Stok',
            'Deskripsi',
            'Action', // Assuming you want to include the "Action" column in the export
        ];
    }
}
