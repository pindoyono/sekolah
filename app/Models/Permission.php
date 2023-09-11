<?php

namespace App\Models;

use App\Models\Team;
// use Illuminate\Database\Eloquent\Model;
// use Spatie\Permission\Models\ as PermissionModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    use HasFactory;

    // public static function boot()
    // {
    //     parent::boot();
    //     self::created(function ($model) {
    //         // ... code here
    //         $team = Team::find(1);
    //         $team->permissions()->attach(1);
    //     });

    // }

    public function team(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_permission', 'permission_id', 'team_id');
        // return $this->belongsToMany(Role::class, 'team_role', 'team_id', 'role_id');
    }

}
