<?php

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
        Schema::create('tatibs', function (Blueprint $table) {
            $table->id();
            $table->string('kelompok_pelanggaran')->nullable();
            $table->text('jenis_pelanggaran')->nullable();
            $table->integer('bobot')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('team_tatib', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->index()->nullable(false);
            $table->foreignIdFor(Tatib::class)->index()->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tatibs');
        Schema::dropIfExists('team_tatib');
    }
};
