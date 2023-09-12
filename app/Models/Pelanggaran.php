<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Tatib;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggaran extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function team(): BelongsToMany
    {
        // return $this->belongsToMany(Team::class);
        return $this->belongsToMany(Team::class, 'team_pelanggaran', 'pelanggaran_id', 'team_id');

    }

    public function tatib(): BelongsToMany
    {
        // return $this->belongsToMany(Team::class);
        return $this->belongsToMany(Tatib::class, 'pelanggarans', 'id', 'tatib_id');

    }

    public function siswa(): BelongsToMany
    {
        // return $this->belongsToMany(Team::class);
        return $this->belongsToMany(Siswa::class, 'pelanggarans', 'id', 'siswa_id');

    }
}
