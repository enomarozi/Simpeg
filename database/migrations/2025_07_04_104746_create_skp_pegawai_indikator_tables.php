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
        Schema::create('skp_pegawai_indikator', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skp_id')->constrained('skp')->onDelete('cascade');
            $table->text('indikator');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skp_pegawai_indikator');
    }
};
