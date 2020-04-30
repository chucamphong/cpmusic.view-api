<?php

namespace App\Policies;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtistPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view.artists') && $user->tokenCan('view.artists');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Artist $artist
     * @return mixed
     */
    public function view(User $user, Artist $artist)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Artist $artist
     * @return mixed
     */
    public function update(User $user, Artist $artist)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Artist $artist
     * @return mixed
     */
    public function delete(User $user, Artist $artist)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Artist $artist
     * @return mixed
     */
    public function restore(User $user, Artist $artist)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Artist $artist
     * @return mixed
     */
    public function forceDelete(User $user, Artist $artist)
    {
        //
    }
}
