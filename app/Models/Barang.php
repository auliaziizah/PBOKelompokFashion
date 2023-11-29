<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'image',
        'image_path',
        'nama_barang',
        'harga',
        'ukuran',
        'bahan',
        'brand',
        'stok',
        'deskripsi'
    ];
}
