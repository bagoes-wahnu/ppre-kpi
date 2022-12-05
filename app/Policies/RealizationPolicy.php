<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Realization;
use Illuminate\Auth\Access\HandlesAuthorization;

class RealizationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Realization  $realization
     * @return mixed
     */
    public function view(User $user, Realization $realization)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Realization  $realization
     * @return mixed
     */
    public function update(User $user, Realization $realization)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Realization  $realization
     * @return mixed
     */
    public function delete(User $user, Realization $realization)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Realization  $realization
     * @return mixed
     */
    public function restore(User $user, Realization $realization)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Realization  $realization
     * @return mixed
     */
    public function forceDelete(User $user, Realization $realization)
    {
        //
    }

    public function approve(User $user, Realization $realization)
    {
        if ($realization->status != 1) {
            return false;
        }

        if ($user->id == User::find($realization->unit_id)->atasan) {
            return true;
        }

        return in_array($user->role_id, [1]);
    }

    public function reject(User $user, Realization $realization)
    {
        if ($realization->status != 2) {
            return false;
        }

        if ($user->id == User::find($realization->created_by)->atasan) {
            return true;
        }

        return in_array($user->role_id, [1]);
    }
}
