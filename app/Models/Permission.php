<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Spatie\Permission\Models\ as PermissionModel;
use Spatie\Permission\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    use HasFactory;
    // public function team(): BelongsToMany
    // {
    //     return $this->belongsToMany(Team::class, 'team_role', 'role_id', 'team_id');
    //     // return $this->belongsToMany(Role::class, 'team_role', 'team_id', 'role_id');

    // }
}
