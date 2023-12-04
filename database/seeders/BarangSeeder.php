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
<<<<<<< HEAD

        DB::table('barangs') -> insert(array(
            array(
                'nama_barang' => 'Dress Floral Blue',
                'harga' => '150000',
                'ukuran' => 'X',
                'bahan' => 'Kartun',
                'brand' => 'Zarah',
                'stok' => 100,
                'deskripsi' => 'Bahan lembut dan tebal'
            ),
            array(
                'nama_barang' => 'Dress Floral Blue Dongker',
=======
        try {
            DB::beginTransaction();

            Barang::create([
                'nama_barang' => 'Dress Floral Blue',
>>>>>>> df64529614424895e895aa172e10175288fb6eba
                'harga' => '100000',
                'ukuran' => 'S',
                'bahan' => 'Katun',
                'brand' => 'Zara',
<<<<<<< HEAD
                'stok' => 50,
                'deskripsi' => 'Bahan lembut'
            ),
            array(
                'nama_barang' => 'Dress Floral Faunal',
                'harga' => '200000',
                'ukuran' => 'XXL',
                'bahan' => 'Karton',
                'brand' => 'Zaraman',
                'stok' => 500,
                'deskripsi' => 'Bahan lembut dan tebal hewan'
            )
        ));
        // Barang::create([
        //     'nama_barang' => 'Dress Floral Blue',
        //     'harga' => '100000',
        //     'ukuran' => 'S',
        //     'bahan' => 'Katun',
        //     'brand' => 'Zara',
        //     'stok' => 5,
        //     'deskripsi' => 'Bahan lembut dan tebal'
        // ]);
        // Barang::create([
        //     'nama_barang' => 'Stelan Jas Warna Coklat Tua',
        //     'harga' => '150000',
        //     'ukuran' => 'L',
        //     'bahan' => 'Drill',
        //     'brand' => 'Zara',
        //     'stok' => 4,
        //     'deskripsi' => 'Tebal dan tidak membuat panas'
        // ]);
        // Barang::create([
        //     'nama_barang' => 'Overall Jeans',
        //     'harga' => '90000',
        //     'ukuran' => 'M',
        //     'bahan' => 'Jeans',
        //     'brand' => 'Levis',
        //     'stok' => 10,
        //     'deskripsi' => 'Warna biru muda'
        // ]);

        // DB::commit();
=======
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
>>>>>>> df64529614424895e895aa172e10175288fb6eba
    }
}