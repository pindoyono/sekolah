<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Gtk;
use App\Models\User;

class GtkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Gtk');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Gtk $gtk): bool
    {
        return $user->can('view Gtk');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Gtk');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Gtk $gtk): bool
    {
        return $user->can('update Gtk');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gtk $gtk): bool
    {
        return $user->can('delete Gtk');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Gtk $gtk): bool
    {
        return $user->can('restore Gtk');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Gtk $gtk): bool
    {
        return $user->can('force-delete Gtk');
    }
}
