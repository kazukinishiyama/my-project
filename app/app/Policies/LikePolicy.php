<?php

namespace App\Policies;

use App\Lile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LikePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any liles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the lile.
     *
     * @param  \App\User  $user
     * @param  \App\Lile  $lile
     * @return mixed
     */
    public function view(User $user, Lile $lile)
    {
        //
    }

    /**
     * Determine whether the user can create liles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the lile.
     *
     * @param  \App\User  $user
     * @param  \App\Lile  $lile
     * @return mixed
     */
    public function update(User $user, Lile $lile)
    {
        //
    }

    /**
     * Determine whether the user can delete the lile.
     *
     * @param  \App\User  $user
     * @param  \App\Lile  $lile
     * @return mixed
     */
    public function delete(User $user, Lile $lile)
    {
        //
    }

    /**
     * Determine whether the user can restore the lile.
     *
     * @param  \App\User  $user
     * @param  \App\Lile  $lile
     * @return mixed
     */
    public function restore(User $user, Lile $lile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the lile.
     *
     * @param  \App\User  $user
     * @param  \App\Lile  $lile
     * @return mixed
     */
    public function forceDelete(User $user, Lile $lile)
    {
        //
    }
}
