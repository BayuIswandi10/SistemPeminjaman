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
        Schema::create('sesis', function (Blueprint $table) {
            $table->id('sesi_id');
            $table->string('nama_sesi');
            $table->time('sesi_awal');
            $table->time('sesi_akhir');
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
        Schema::dropIfExists('sesis');
    }
};
