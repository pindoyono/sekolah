<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Sekolah;
use App\Models\User;

class SekolahPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Sekolah');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Sekolah $sekolah): bool
    {
        return $user->can('view Sekolah');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Sekolah');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Sekolah $sekolah): bool
    {
        return $user->can('update Sekolah');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Sekolah $sekolah): bool
    {
        return $user->can('delete Sekolah');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Sekolah $sekolah): bool
    {
        return $user->can('restore Sekolah');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Sekolah $sekolah): bool
    {
        return $user->can('force-delete Sekolah');
    }
}
