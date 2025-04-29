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
        Schema::create('pegawai_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('jenjang',10);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai_pendidikan');
    }
};
