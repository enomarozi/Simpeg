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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip',20)->unique();
            $table->string('nama',100);
            $table->string('gelar_depan',50)->nullable();
            $table->string('gelar_belakang',50)->nullable();
            $table->enum('status',['Aktif','Tidak Aktif']);
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('tempat_lahir',100);
            $table->date('tanggal_lahir');
            

            $table->foreignId('agama_id')->constrained('agama')->onDelete('restrict');
            $table->foreignId('jenis_kepegawaian_id')->constrained('jenis_kepegawaian')->onDelete('restrict');
            $table->foreignId('kategori_kepegawaian_id')->constrained('kategori_kepegawaian')->onDelete('restrict');
            $table->foreignId('departemen_id')->constrained('departemen')->onDelete('restrict');
            $table->foreignId('kepangkatan_id')->constrained('kepangkatan')->onDelete('restrict');

            $table->timestamps();
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
