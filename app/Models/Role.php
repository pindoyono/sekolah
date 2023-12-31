<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Spatie\Permission\Models\Role as RoleModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role as RoleModel;

class Role extends RoleModel
{
    use HasFactory;
    public function team(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_role', 'role_id', 'team_id');
        // return $this->belongsToMany(Role::class, 'team_role', 'team_id', 'role_id');
    }
}
