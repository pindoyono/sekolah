<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tatib extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function team(): BelongsToMany
    {
        // return $this->belongsToMany(Team::class);
        return $this->belongsToMany(Team::class, 'team_tatib', 'tatib_id', 'team_id');

    }

    public function getTatibBobotAttribute()
    {
        return $this->jenis_pelanggaran . ' - ' . $this->bobot;
    }

}
