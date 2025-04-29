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
        Schema::create('jabatan_pegawai', function (Blueprint $table) {
            $table->id();
            $table->date('tmt');

            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('restrict');
            $table->foreignId('jabatan_id')->constrained('pegawai_jabatan')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_pegawai');
    }
};
