<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Tatib;
use App\Models\User;

class TatibPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Tatib');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tatib $tatib): bool
    {
        return $user->can('view Tatib');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Tatib');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tatib $tatib): bool
    {
        return $user->can('update Tatib');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tatib $tatib): bool
    {
        return $user->can('delete Tatib');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tatib $tatib): bool
    {
        return $user->can('restore Tatib');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tatib $tatib): bool
    {
        return $user->can('force-delete Tatib');
    }
}
