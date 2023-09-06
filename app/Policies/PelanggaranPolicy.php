<?php

namespace App\Policies;

use App\Models\Pelanggaran;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PelanggaranPolicy
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
        return $user->can('view_any_pelanggaran');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pelanggaran  $pelanggaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Pelanggaran $pelanggaran): bool
    {
        return $user->can('view_pelanggaran');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_pelanggaran');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pelanggaran  $pelanggaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Pelanggaran $pelanggaran): bool
    {
        return $user->can('update_pelanggaran');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pelanggaran  $pelanggaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Pelanggaran $pelanggaran): bool
    {
        return $user->can('delete_pelanggaran');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_pelanggaran');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pelanggaran  $pelanggaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Pelanggaran $pelanggaran): bool
    {
        return $user->can('force_delete_pelanggaran');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_pelanggaran');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pelanggaran  $pelanggaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Pelanggaran $pelanggaran): bool
    {
        return $user->can('restore_pelanggaran');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_pelanggaran');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pelanggaran  $pelanggaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, Pelanggaran $pelanggaran): bool
    {
        return $user->can('replicate_pelanggaran');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_pelanggaran');
    }

}
