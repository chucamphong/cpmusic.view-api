<?php

namespace App\Policies;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtistPolicy
{
    use HandlesAuthorization;

    /**
     * @param User|null $user
     * @return bool
     * @noinspection PhpUnused
     * @noinspection PhpUnusedParameterInspection
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * @noinspection PhpUnusedParameterInspection
     */
    public function view(?User $user, Artist $artist): bool
    {
        return true;
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
