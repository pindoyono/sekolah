<?php

use App\Models\Permission;
use App\Models\Role;
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
        //
        Schema::create('team_role', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->index()->nullable(false);
            $table->foreignIdFor(Role::class)->index()->nullable(false);

            $table->timestamps();
        });

        Schema::create('team_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->index()->nullable(false);
            $table->foreignIdFor(Permission::class)->index()->nullable(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('team_permission');
        Schema::dropIfExists('team_role');
    }
};
