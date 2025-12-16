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
        Schema::create('pegawai_informasi_bank', function(Blueprint $table){
            $table->id();
            $table->foreignId('pegawai_id')->nullable()->constrained('pegawai')->onDelete('restrict');
            $table->foreignId('bank_id')->nullable()->constrained('pegawai_nama_banks')->onDelete('restrict');
            $table->string('no_rekening')->nullable()->unique();
            $table->string('nama_penerima')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai_informasi_alamat');
    }
};
