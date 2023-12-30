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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id('fasilitas_id');
            $table->string('nama_fasilitas');
            $table->string('foto_fasilitas');
            $table->foreignId('created_by')->constrained('penggunas', 'pengguna_id');       
            $table->timestamp('created_date')->useCurrent();
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
        Schema::dropIfExists('fasilitas');
    }
};
