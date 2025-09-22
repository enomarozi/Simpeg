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
        Schema::create('logs_harian', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_aktivitas');
            $table->text('deskripsi');
            $table->foreignId('periode_id')->constrained('skp_periode')->onDelete('cascade');
            $table->string('skp')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kalender_log');
    }
};
