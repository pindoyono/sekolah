<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'semester_id', 'slug',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_user', 'team_id', 'user_id');

    }

    public function siswas(): BelongsToMany
    {
        // dd($this->belongsToMany(User::class));

        return $this->belongsToMany(Siswa::class);

    }

    public function sekolahs(): BelongsToMany
    {
        // return $this->belongsToMany(Sekolah::class);
        return $this->belongsToMany(Sekolah::class, 'team_sekolah', 'team_id', 'sekolah_id');
    }

    public function rombels(): BelongsToMany
    {
        return $this->belongsToMany(Rombel::class);
    }

    public function pembelajarans(): BelongsToMany
    {
        return $this->belongsToMany(Pembelajaran::class);
    }

    public function pelanggarans(): BelongsToMany
    {
        return $this->belongsToMany(Pelanggaran::class);
    }

    public function gtks(): BelongsToMany
    {
        return $this->belongsToMany(Gtk::class, 'team_user', 'team_id', 'user_id');
    }

}
