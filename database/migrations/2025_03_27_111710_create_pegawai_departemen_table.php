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
        Schema::create('pegawai_departemen', function(Blueprint $table){
            $table->id();
            $table->string('nama_departemen', 100);
            $table->foreignId('fakultas_id')->nullable()->constrained('pegawai_fakultas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_departemen');
    }
};
