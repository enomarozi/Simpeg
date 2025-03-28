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
        Schema::create('jenis_kepegawaian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jenis_kepegawaian',30);
            //$table->unsignedBigInteger('id_kategori_kepegawaian');
            //$table->foreign('id_kategori_kepegawaian')->references('id')->on('kategori_kepegawaian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_kepegawaian');
    }
};
