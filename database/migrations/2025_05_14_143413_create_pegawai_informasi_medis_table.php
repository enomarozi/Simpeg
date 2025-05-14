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
        Schema::create('pegawai_informasi_medis', function(Blueprint $table){
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('restrict');
            $table->foreignId('golongan_darah_id')->constrained('pegawai_golongan_darah')->onDelete('restrict');
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('cacat')->nullable();   

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_informasi_medis');
    }
};
