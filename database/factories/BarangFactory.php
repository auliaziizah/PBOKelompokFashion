<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_barang'=>fake()->text(10),
            'harga'=>fake()->randomNumber(),
            'ukuran'=>fake()->text(10),
            'bahan'=>fake()->text(10),
            'brand'=>fake()->text(10),
            'stok'=>fake()->randomNumber(),
            'deskripsi'=>fake()->text(10),
        ];
    }
}
