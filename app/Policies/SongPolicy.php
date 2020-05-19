<?php

namespace App\Policies;

use App\Models\Song;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SongPolicy
{
    use HandlesAuthorization;

    /** @noinspection PhpUnused */
    public function viewAny(User $user): bool
    {
        return $user->can('view.songs') && $user->tokenCan('view.songs');
    }

    /** @noinspection PhpUnusedParameterInspection */
    public function view(User $user, Song $song): bool
    {
        return $user->can('view.songs') && $user->tokenCan('view.songs');
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
