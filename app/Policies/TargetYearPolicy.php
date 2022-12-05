<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TargetYear;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Arr;

class TargetYearPolicy
{
    use HandlesAuthorization;

    protected $roles = [
        'admin' => 1,
        'direksi' => 2,
        'korporat' => 3,
        'unit' => 4
    ];

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
     * @param  \App\TargetYear  $targetYear
     * @return mixed
     */
    public function view(User $user, TargetYear $targetYear)
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
        return in_array(
            $user->role_id,
            [
                $this->roles['admin']
            ]
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\TargetYear  $targetYear
     * @return mixed
     */
    public function update(User $user, TargetYear $targetYear)
    {
        return in_array(
            $user->role_id,
            [
                $this->roles['admin']
            ]
        );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\TargetYear  $targetYear
     * @return mixed
     */
    public function delete(User $user, TargetYear $targetYear)
    {
        return in_array(
            $user->role_id,
            [
                $this->roles['admin']
            ]
        );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\TargetYear  $targetYear
     * @return mixed
     */
    public function restore(User $user, TargetYear $targetYear)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\TargetYear  $targetYear
     * @return mixed
     */
    public function forceDelete(User $user, TargetYear $targetYear)
    {
        //
    }
}
