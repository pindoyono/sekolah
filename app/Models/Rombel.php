<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rombel extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class, 'rombongan_belajar_id', 'rombongan_belajar_id');

        // return $this->belongsTo(Post::class, 'foreign_key', 'owner_key');
    }

    public function team(): BelongsToMany
    {
        // return $this->belongsToMany(Team::class);
        return $this->belongsToMany(Team::class, 'team_rombel', 'rombel_id', 'team_id');

    }

}
