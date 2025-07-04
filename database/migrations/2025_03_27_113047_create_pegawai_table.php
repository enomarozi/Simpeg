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
            $table->string('nip',30)->nullable();
            $table->string('nama',100);
            $table->string('gelar_depan',50)->nullable();
            $table->string('gelar_belakang',50)->nullable();
            $table->enum('status',['Aktif','Tidak Aktif','Pindah Masuk']);
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('tempat_lahir',100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->foreignId('agama_id')->nullable()->constrained('pegawai_agama')->onDelete('restrict');
            $table->foreignId('jenis_kepegawaian_id')->nullable()->constrained('pegawai_jenis_kepegawaian')->onDelete('restrict');
            $table->foreignId('kategori_kepegawaian_id')->nullable()->constrained('pegawai_kategori_kepegawaian')->onDelete('restrict');
            $table->foreignId('fakultas_id')->nullable()->constrained('pegawai_fakultas')->onDelete('restrict');
            $table->foreignId('departemen_id')->nullable()->constrained('pegawai_departemen')->onDelete('restrict');
            $table->date('tmt_cpns')->nullable();
            $table->foreignId('kepangkatan_id')->nullable()->constrained('pegawai_kepangkatan')->onDelete('restrict');
            $table->date('tmt_pangkat')->nullable();
            $table->foreignId('jabatan_id')->nullable()->constrained('pegawai_jabatan_dosen')->onDelete('restrict');
            $table->foreignId('pendidikan_id')->nullable()->constrained('pegawai_pendidikan')->onDelete('restrict');
            $table->date('tmt_pensiun')->nullable();
            $table->string('tahun_pensiun',4)->nullable();
            $table->string('telepon',20)->unique()->nullable();
            $table->string('hp',20)->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->foreignId('perkawinan_id')->nullable()->constrained('pegawai_status_perkawinan')->onDelete('restrict');
            $table->foreignId('kewarganegaraan_id')->nullable()->constrained('pegawai_kewarganegaraan')->onDelete('restrict');
            $table->foreignId('negara_id')->nullable()->constrained('pegawai_negara')->onDelete('restrict');
            $table->integer('atasan_id')->nullable();
            $table->timestamps();
            
            
        });

    }
    public function atasan()
    {
        return $this->belongsTo(Pegawai::class, 'atasan_id');
    }

    public function bawahan()
    {
        return $this->hasMany(Pegawai::class, 'atasan_id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
