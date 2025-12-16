<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawai_informasi_unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->nullable()->constrained('pegawai')->onDelete('restrict');
            $table->date('tgl_masuk')->nullable();
            $table->string('putusan')->nullable();
            $table->string('no_surat_u')->nullable();
            $table->date('tgl_sk')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai_informasi_unit_kerja');
    }
};
