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
        Schema::create('tb_ekspedisi', function (Blueprint $table) {
            $table->string('id_ekspedisi')->primary()->unique();
            $table->string('nama_ekspedisi');
            $table->text('alamat_ekspedisi');
            $table->string('no_hp_ekspedisi');
            $table->string('gambar_ekspedisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ekspedisi');
    }
};