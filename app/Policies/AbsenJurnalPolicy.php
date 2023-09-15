<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\AbsenJurnal;
use App\Models\User;

class AbsenJurnalPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any AbsenJurnal');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AbsenJurnal $absenjurnal): bool
    {
        return $user->can('view AbsenJurnal');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create AbsenJurnal');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AbsenJurnal $absenjurnal): bool
    {
        return $user->can('update AbsenJurnal');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AbsenJurnal $absenjurnal): bool
    {
        return $user->can('delete AbsenJurnal');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AbsenJurnal $absenjurnal): bool
    {
        return $user->can('restore AbsenJurnal');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AbsenJurnal $absenjurnal): bool
    {
        return $user->can('force-delete AbsenJurnal');
    }
}
