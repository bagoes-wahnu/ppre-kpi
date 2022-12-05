<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Target;
use Illuminate\Auth\Access\HandlesAuthorization;

class TargetPolicy
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
     * @param  \App\Target  $target
     * @return mixed
     */
    public function view(User $user, Target $target)
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
        // role
        return in_array($user->role_id, [
            1, // admin
            // 2, // direksi
            3, // korporat
            4, // unit
        ]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Target  $target
     * @return mixed
     */
    public function update(User $user, Target $target)
    {
        // status
        if (!in_array($target->status, [
            0, // draf
            // 1, // pending approve
            // 2, // approve
            3, // rollback
        ])) {
            return false;
        }

        // user
        if ($user->id == $target->created_by) {
            return true;
        }

        // role
        return in_array($user->role_id, [
            1, // admin
            // 2, // direksi
            // 3, // korporat
            // 4, // unit
        ]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Target  $target
     * @return mixed
     */
    public function delete(User $user, Target $target)
    {
        // user
        if ($user->id == $target->created_by) {
            return true;
        }

        // role
        return in_array($user->role_id, [
            1, // admin
            // 2, // direksi
            // 3, // korporat
            // 4, // unit
        ]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Target  $target
     * @return mixed
     */
    public function restore(User $user, Target $target)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Target  $target
     * @return mixed
     */
    public function forceDelete(User $user, Target $target)
    {
        //
    }

    /**
     * Determine whether the user can approve.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Target  $target
     * @return mixed
     */
    public function approve(User $user, Target $target)
    {
        /**
         * role yg bisa melakukan approval
         * admin
         * direksi / atasan satu tingkat diatas
         */
        if (!in_array($user->role_id, [
            1, // admin
            2, // direksi
            // 3, // korporat
            // 4, // unit
        ])) {
            return false;
        }

        // status
        return in_array($target->status, [
            // 0, // draf
            1, // pending approve
            // 2, // approve
            // 3, // reject
        ]);
    }

    /**
     * Determine whether the user can rollback.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Target  $target
     * @return mixed
     */
    public function reject(User $user, Target $target)
    {
        // role
        if (!in_array($user->role_id, [
            1, // admin
            2, // direksi
            // 3, // korporat
            // 4, // unit
        ])) {
            return false;
        }

        // status
        return in_array($target->status, [
            // 0, // draf
            1, // pending approve
            // 2, // approve
            // 3, // rollback
        ]);
    }
}
