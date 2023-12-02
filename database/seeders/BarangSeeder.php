<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();

            Barang::create([
                'nama_barang' => 'Dress Floral Blue',
                'harga' => '100000',
                'ukuran' => 'S',
                'bahan' => 'Katun',
                'brand' => 'Zara',
                'stok' => 5,
                'deskripsi' => 'Bahan lembut dan tebal'
            ]);
            Barang::create([
                'nama_barang' => 'Stelan Jas Warna Coklat Tua',
                'harga' => '150000',
                'ukuran' => 'L',
                'bahan' => 'Drill',
                'brand' => 'Zara',
                'stok' => 4,
                'deskripsi' => 'Tebal dan tidak membuat panas'
            ]);
            Barang::create([
                'nama_barang' => 'Overall Jeans',
                'harga' => '90000',
                'ukuran' => 'M',
                'bahan' => 'Jeans',
                'brand' => 'Levis',
                'stok' => 10,
                'deskripsi' => 'Warna biru muda'
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}