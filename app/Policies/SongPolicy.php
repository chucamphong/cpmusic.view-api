<?php

namespace App\Policies;

use App\Models\Song;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SongPolicy
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
     * @param User|null $user
     * @param Song $song
     * @return bool
     * @noinspection PhpUnusedParameterInspection
     */
    public function view(?User $user, Song $song): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->can('create.songs') && $user->tokenCan('create.songs');
    }

    /** @noinspection PhpUnusedParameterInspection */
    public function update(User $user, Song $song): bool
    {
        return $user->can('update.songs') && $user->tokenCan('update.songs');
    }

    /** @noinspection PhpUnusedParameterInspection */
    public function delete(User $user, Song $song): bool
    {
        return $user->can('delete.songs') && $user->tokenCan('delete.songs');
    }
}
