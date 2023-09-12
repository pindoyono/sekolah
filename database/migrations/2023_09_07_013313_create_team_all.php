<?php

use App\Models\Gtk;
use App\Models\Pembelajaran;
use App\Models\Rombel;
use App\Models\Sekolah;
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
        Schema::create('team_gtk', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->index()->nullable(false);
            $table->foreignIdFor(Gtk::class)->index()->nullable(false);
            $table->timestamps();
        });

        Schema::create('team_pembelajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->index()->nullable(false);
            $table->foreignIdFor(Pembelajaran::class)->index()->nullable(false);
            $table->timestamps();
        });

        Schema::create('team_rombel', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->index()->nullable(false);
            $table->foreignIdFor(Rombel::class)->index()->nullable(false);
            $table->timestamps();
        });

        Schema::create('team_sekolah', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->index()->nullable(false);
            $table->foreignIdFor(Sekolah::class)->index()->nullable(false);
            $table->timestamps();
        });

        Schema::create('team_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->index()->nullable(false);
            $table->foreignIdFor(Siswa::class)->index()->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_gtk');
        Schema::dropIfExists('team_pembelajaran');
        Schema::dropIfExists('team_rombel');
        Schema::dropIfExists('team_sekolah');
        Schema::dropIfExists('team_siswa');
    }
};
