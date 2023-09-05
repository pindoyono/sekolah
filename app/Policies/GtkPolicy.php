<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gtk;
use Illuminate\Auth\Access\HandlesAuthorization;

class GtkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_gtk');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gtk  $gtk
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Gtk $gtk): bool
    {
        return $user->can('view_gtk');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_gtk');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gtk  $gtk
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Gtk $gtk): bool
    {
        return $user->can('update_gtk');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gtk  $gtk
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Gtk $gtk): bool
    {
        return $user->can('delete_gtk');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_gtk');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gtk  $gtk
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Gtk $gtk): bool
    {
        return $user->can('force_delete_gtk');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_gtk');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gtk  $gtk
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Gtk $gtk): bool
    {
        return $user->can('restore_gtk');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_gtk');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gtk  $gtk
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, Gtk $gtk): bool
    {
        return $user->can('replicate_gtk');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_gtk');
    }

}
