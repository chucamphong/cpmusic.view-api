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

    /** @noinspection PhpUnusedParameterInspection */
    public function view(User $user, Artist $artist): bool
    {
        return $user->can('view.artists') && $user->tokenCan('view.artists');
    }

    public function create(User $user): bool
    {
        return $user->can('create.artists') && $user->tokenCan('create.artists');
    }

    /** @noinspection PhpUnusedParameterInspection */
    public function update(User $user, Artist $artist): bool
    {
        return $user->can('update.artists') && $user->tokenCan('update.artists');
    }

    /** @noinspection PhpUnusedParameterInspection */
    public function delete(User $user, Artist $artist): bool
    {
        return $user->can('delete.artists') && $user->tokenCan('delete.artists');
    }
}
