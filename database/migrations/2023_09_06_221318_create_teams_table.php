<?php

use App\Models\Team;
use App\Models\User;
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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('semester_id')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        Schema::create('team_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->index()->nullable(false);
            $table->foreignIdFor(User::class)->index()->nullable(false);

            $table->timestamps();
        });

        // Schema::create('team_sekolah', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignIdFor(Sekolah::class)->index();
        //     $table->foreignIdFor(User::class)->index();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
        Schema::dropIfExists('team_user');
    }
};
