<?php

namespace App\Models;

use App\Models\Gtk;
use App\Models\Pembelajaran;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\Siswa;
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

        // return $this->belongsToMany(Siswa::class);
        return $this->belongsToMany(Siswa::class, 'team_siswa', 'team_id', 'siswa_id');

    }

    public function sekolahs(): BelongsToMany
    {
        // return $this->belongsToMany(Sekolah::class);
        return $this->belongsToMany(Sekolah::class, 'team_sekolah', 'team_id', 'sekolah_id');
    }

    public function rombels(): BelongsToMany
    {
        // return $this->belongsToMany(Rombel::class);
        return $this->belongsToMany(Rombel::class, 'team_rombel', 'team_id', 'rombel_id');

    }

    public function pembelajarans(): BelongsToMany
    {
        // return $this->belongsToMany(Pembelajaran::class);
        return $this->belongsToMany(Pembelajaran::class, 'team_pembelajaran', 'team_id', 'pembelajaran_id');

    }

    public function tatibs(): BelongsToMany
    {
        // return $this->belongsToMany(Pelanggaran::class);
        return $this->belongsToMany(Tatib::class, 'team_tatib', 'team_id', 'tatib_id');

    }

    public function pelanggarans(): BelongsToMany
    {
        // return $this->belongsToMany(Pelanggaran::class);
        return $this->belongsToMany(Pelanggaran::class, 'team_pelanggaran', 'team_id', 'pelanggaran_id');

    }

    public function gtks(): BelongsToMany
    {
        // return $this->belongsToMany(Gtk::class, 'team_user', 'team_id', 'user_id');

        return $this->belongsToMany(Gtk::class, 'team_gtk', 'team_id', 'gtk_id');

    }

    public function permissions(): BelongsToMany
    {
        // return $this->belongsToMany(Gtk::class, 'team_user', 'team_id', 'user_id');

        return $this->belongsToMany(Permission::class, 'team_permission', 'team_id', 'permission_id');

    }

    public function roles(): BelongsToMany
    {
        // return $this->belongsToMany(Gtk::class, 'team_user', 'team_id', 'user_id');

        return $this->belongsToMany(Role::class, 'team_role', 'team_id', 'role_id');

    }

}
