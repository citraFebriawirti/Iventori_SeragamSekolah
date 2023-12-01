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
        Schema::create('tb_barang_keluar', function (Blueprint $table) {
            $table->string('id_barang_keluar')->primary()->unique();
            $table->string('nama_barang_keluar')->nullable();
            $table->integer('jumlah_barang_keluar')->nullable();
            $table->date('tanggal_barang_keluar')->nullable();
            $table->string('gambar_barang_keluar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_barang_keluar');
    }
};