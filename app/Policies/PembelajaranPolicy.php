<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Pembelajaran;
use App\Models\User;

class PembelajaranPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Pembelajaran');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pembelajaran $pembelajaran): bool
    {
        return $user->can('view Pembelajaran');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Pembelajaran');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pembelajaran $pembelajaran): bool
    {
        return $user->can('update Pembelajaran');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pembelajaran $pembelajaran): bool
    {
        return $user->can('delete Pembelajaran');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pembelajaran $pembelajaran): bool
    {
        return $user->can('restore Pembelajaran');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pembelajaran $pembelajaran): bool
    {
        return $user->can('force-delete Pembelajaran');
    }
}
