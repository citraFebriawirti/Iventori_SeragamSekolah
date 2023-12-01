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
        Schema::create('tb_barang_masuk', function (Blueprint $table) {
            $table->string('id_barang_masuk')->primary()->unique();
            $table->string('nama_barang_masuk')->nullable();
            $table->integer('jumlah_barang_masuk')->nullable();
            $table->date('tanggal_barang_masuk')->nullable();
            $table->string('gambar_barang_masuk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_barang_masuk');
    }
};