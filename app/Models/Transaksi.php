<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'user_id', 
        'total_harga',
        'jumlah_uang',
        'kembalian', 
        'transaksi_code', 
        'tanggal'
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->transaksi_code = $model->generateRandomString();
        });
    }

    private function generateRandomString($length = 6)
    {
        $characters = '-123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString . "" . date("YmdHis");
    }

    public function items()
    {
        return $this->hasMany(TransaksiItem::class, 'id_transaksi');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
