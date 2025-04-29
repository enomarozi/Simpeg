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
        Schema::create('kepangkatan_pegawai', function(Blueprint $table){
            $table->id();
            $table->date('tmt');

            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('restrict');
            $table->foreignId('kepangkatan_id')->constrained('pegawai_kepangkatan')->onDelete('restrict');

            $table->unique(['pegawai_id', 'kepangkatan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepangkatan_pegawai');
    }
};
