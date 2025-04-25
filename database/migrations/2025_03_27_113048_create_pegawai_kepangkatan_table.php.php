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
        Schema::create('pegawai_kepangkatan', function(Blueprint $table){
            $table->id();
            $table->date('tmt');

            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('restrict');
            $table->foreignId('kepangkatan_id')->constrained('kepangkatan')->onDelete('restrict');

            $table->unique(['pegawai_id', 'kepangkatan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_kepangkatan');
    }
};
