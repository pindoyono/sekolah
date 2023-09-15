<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JurnalKelas extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function team(): BelongsToMany
    {
        // return $this->belongsToMany(Team::class);
        return $this->belongsToMany(Team::class, 'team_jurnal', 'jurnal_kelas_id', 'team_id');
    }

    public function absen_jurnals(): HasMany
    {
        return $this->hasMany(AbsenJurnal::class, 'jurnal_kelas_id', 'id');
    }
}
