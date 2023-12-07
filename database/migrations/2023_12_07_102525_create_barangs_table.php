<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_barang', function (Blueprint $table) {
            $table->string('id_barang')->primary()->unique();
            $table->string('id_kategori')->nullable();
            $table->string('id_gender')->nullable();
            $table->string('id_model')->nullable();
            $table->string('id_busana')->nullable();
            $table->string('id_bahan')->nullable();
            $table->string('id_ukuran')->nullable();
            $table->string('id_jenis')->nullable();
            $table->string('nama_barang')->nullable();
            $table->integer('jumlah_barang')->nullable();
            $table->string('gambar_barang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_barang');
    }
};