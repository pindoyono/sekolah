<?php

use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\Tatib;
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
        Schema::create('pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            $table->timestamps();
            $table->softDeletes();

            $table->foreignIdFor(Siswa::class)->index()->nullable(false);
            $table->foreignIdFor(Tatib::class)->index()->nullable(false);

        });

        Schema::create('team_pelanggaran', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->index()->nullable(false);
            $table->foreignIdFor(Pelanggaran::class)->index()->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggarans');
        Schema::dropIfExists('team_pelanggaran');
    }
};
