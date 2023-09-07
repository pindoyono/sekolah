<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pembelajaran extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function team(): BelongsToMany
    {
        // return $this->belongsToMany(Team::class);
        return $this->belongsToMany(Team::class, 'team_pembelajaran', 'pembelajaran_id', 'team_id');

    }
}
