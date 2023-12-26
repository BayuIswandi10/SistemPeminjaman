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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id('barang_id');
            $table->string('nama_barang');
            $table->string('nomor_aktiva')->nullable();
            $table->string('tipe_barang');
            $table->integer('stok');
            $table->string('satuan_barang');
            $table->string('keterangan_barang')->nullable();
            $table->string('lokasi_barang');
            $table->string('baris_lokasi');
            $table->string('gambar_barang')->nullable();
            $table->foreignId('created_by')->constrained('penggunas', 'pengguna_id');       
            $table->timestamp('created_date')->useCurrent();
            $table->string('status');
            $table->timestamps(false); // Menonaktifkan timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
};
