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
        Schema::create('rombels', function (Blueprint $table) {
            $table->id();
            $table->string('rombongan_belajar_id')->unique()->nullable();
            $table->string('nama')->nullable();
            $table->string('tingkat_pendidikan_id')->nullable();
            $table->string('tingkat_pendidikan_id_str')->nullable();
            $table->string('semester_id')->nullable();
            $table->string('jenis_rombel')->nullable();
            $table->string('jenis_rombel_str')->nullable();
            $table->string('kurikulum_id')->nullable();
            $table->string('kurikulum_id_str')->nullable();
            $table->string('id_ruang')->nullable();
            $table->string('id_ruang_str')->nullable();
            $table->string('moving_class')->nullable();
            $table->string('ptk_id')->nullable();
            $table->string('ptk_id_str')->nullable();
            $table->string('jurusan_id')->nullable();
            $table->string('jurusan_id_str')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rombels');
    }
};
