<?php

namespace App\Policies;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtistPolicy
{
    use HandlesAuthorization;

    /** @noinspection PhpUnused */
    public function viewAny(User $user): bool
    {
        return $user->can('view.artists') && $user->tokenCan('view.artists');
    }

    public function view(User $user, Artist $artist)
    {
        return $user->can('view.artists') && $user->tokenCan('view.artists');
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Artist $artist)
    {
        //
    }

    public function delete(User $user, Artist $artist)
    {
        return $user->can('delete.artists') && $user->tokenCan('delete.artists');
    }

    public function restore(User $user, Artist $artist)
    {
        //
    }

    /** @noinspection PhpUnused */
    public function forceDelete(User $user, Artist $artist)
    {
        //
    }
}
