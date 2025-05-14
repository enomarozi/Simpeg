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
        Schema::create('pegawai_informasi_id', function(Blueprint $table){
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('restrict');
            $table->string('no_ktp')->unique()->nullable();
            $table->string('no_npwp')->unique()->nullable();
            $table->string('no_bpjs_tenaga_kerja')->unique()->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_informasi_id');
    }
};
