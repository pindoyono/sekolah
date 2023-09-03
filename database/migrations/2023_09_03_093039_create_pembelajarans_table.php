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
        Schema::create('pembelajarans', function (Blueprint $table) {
            $table->id();
            $table->string('pembelajaran_id')->unique()->nullable();
            $table->string('mata_pelajaran_id')->nullable();
            $table->string('mata_pelajaran_id_str')->nullable();
            $table->string('ptk_terdaftar_id')->nullable();
            $table->string('ptk_id')->nullable();
            $table->string('nama_mata_pelajaran')->nullable();
            $table->string('induk_pembelajaran_id')->nullable();
            $table->string('jam_mengajar_per_minggu')->nullable();
            $table->string('status_di_kurikulum')->nullable();
            $table->string('status_di_kurikulum_str')->nullable();
            $table->string('rombongan_belajar_id')->nullable();
            $table->timestamps();

            $table->foreign('rombongan_belajar_id')->references('rombongan_belajar_id')->on('rombels')->onDelete('cascade');
            $table->foreign('ptk_id')->references('ptk_id')->on('gtks')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelajarans');
    }
};
