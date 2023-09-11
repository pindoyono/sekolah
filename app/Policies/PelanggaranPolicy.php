<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Pelanggaran;
use App\Models\User;

class PelanggaranPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Pelanggaran');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pelanggaran $pelanggaran): bool
    {
        return $user->can('view Pelanggaran');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Pelanggaran');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pelanggaran $pelanggaran): bool
    {
        return $user->can('update Pelanggaran');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pelanggaran $pelanggaran): bool
    {
        return $user->can('delete Pelanggaran');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pelanggaran $pelanggaran): bool
    {
        return $user->can('restore Pelanggaran');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pelanggaran $pelanggaran): bool
    {
        return $user->can('force-delete Pelanggaran');
    }
}
