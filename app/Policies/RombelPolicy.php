<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Rombel;
use App\Models\User;

class RombelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Rombel');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Rombel $rombel): bool
    {
        return $user->can('view Rombel');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Rombel');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Rombel $rombel): bool
    {
        return $user->can('update Rombel');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Rombel $rombel): bool
    {
        return $user->can('delete Rombel');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Rombel $rombel): bool
    {
        return $user->can('restore Rombel');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Rombel $rombel): bool
    {
        return $user->can('force-delete Rombel');
    }
}
