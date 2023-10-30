<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_daftar_barang', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang', '100');
            $table->string('nama_barang', '255');
            $table->integer('harga');
            $table->string('ukuran', '5');
            $table->string('status', '20');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_daftar_barang');
    }
};
