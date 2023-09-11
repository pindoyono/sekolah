<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Siswa;
use App\Models\User;

class SiswaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Siswa');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Siswa $siswa): bool
    {
        return $user->can('view Siswa');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Siswa');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Siswa $siswa): bool
    {
        return $user->can('update Siswa');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Siswa $siswa): bool
    {
        return $user->can('delete Siswa');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Siswa $siswa): bool
    {
        return $user->can('restore Siswa');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Siswa $siswa): bool
    {
        return $user->can('force-delete Siswa');
    }
}
