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
        Schema::create('skp_intervensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atasan_id')->constrained('pegawai')->onDelete('cascade');
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->foreignId('periode_id')->constrained('skp_periode')->onDelete('cascade');
            $table->foreignId('skp_id')->constrained('skp')->onDelete('cascade');
            $table->enum('status', ['diintervensi', 'diajukan', 'diterima', 'ditolak'])->default('diintervensi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skp_intervensi_tables');
    }
};
