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
        Schema::create('skp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->foreignId('atasan_id')->constrained('pegawai')->onDelete('cascade');
            $table->foreignId('periode_id')->constrained('skp_periode')->onDelete('cascade');
            $table->unsignedBigInteger('pelaksanaan_skp');
            $table->unsignedBigInteger('intervensi_skp');
            $table->unsignedTinyInteger('jenis_skp');
            $table->text('skp')->nullable();
            $table->enum('status', ['draft', 'disetujui', 'ditolak'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skp');
    }
};
