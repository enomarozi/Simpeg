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
            $table->string('nip_baru',20)->unique();
            $table->string('nama',100);
            $table->string('gelar_depan',50)->nullable();
            $table->string('gelar_belakang',50)->nullable();
            $table->enum('status',['Aktif','Tidak Aktif']);
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('tempat_lahir',100);
            $table->date('tanggal_lahir');
            $table->unsignedBigInteger('id_agama');
            $table->unsignedBigInteger('id_status_kepegawaian');
            $table->unsignedBigInteger('id_fakultas');
            $table->unsignedBigInteger('id_kepangkatan');
            $table->timestamps();

            $table->foreign('id_agama')->references('id')->on('agama')->onDelete('cascade');
            $table->foreign('id_fakultas')->references('id')->on('fakultas')->onDelete('cascade');
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
