<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(?User $currentUser, User $user)
    {
        if (is_null($currentUser)) {
            return false;
        }

        // Có quyền xem thông tin chính bản thân
        if ($currentUser->is($user)) {
            return $currentUser->can('view.me') && $currentUser->tokenCan('view.me');
        }

        // Có quyền xem những thông tin của người khác
        if ($currentUser->isNot($user)) {
            return $currentUser->can('view.users') && $currentUser->tokenCan('view.users');
        }

        return false;
    }
}
