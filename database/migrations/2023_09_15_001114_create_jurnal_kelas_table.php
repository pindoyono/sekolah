<?php

use App\Models\JurnalKelas;
use App\Models\Siswa;
use App\Models\Team;
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
        Schema::create('jurnal_kelas', function (Blueprint $table) {
            $table->id();
            $table->integer('minggu_ke');
            $table->date('tgl');
            $table->integer('jam_ke');
            $table->string('rombel_id');
            $table->string('ptk_id');
            $table->string('mata_pelajaran');
            $table->text('materi_pelajaran');
            $table->text('kegiatan_pelajaran');

            $table->timestamps();
            $table->softDeletes();

            // $table->foreignIdFor(Siswa::class)->index()->nullable(false);
            // $table->foreignIdFor(Tatib::class)->index()->nullable(false);
        });

        Schema::create('absen_jurnals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(JurnalKelas::class)->index()->nullable(false);
            $table->foreignIdFor(Siswa::class)->index()->nullable(false);
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::create('team_jurnal', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->index()->nullable(false);
            $table->foreignIdFor(JurnalKelas::class)->index()->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen_jurnals');
        Schema::dropIfExists('jurnal_kelas');
        Schema::dropIfExists('team_jurnal');

    }
};
