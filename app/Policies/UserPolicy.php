<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /** @noinspection PhpUnused */
    public function viewAny(User $user): bool
    {
        return $user->can('view.users') && $user->tokenCan('view.users');
    }

    public function view(User $currentUser, User $user): bool
    {
        // Kiểm tra xem thông tin chính bản thân
        if ($currentUser->is($user)) {
            return $currentUser->can('view.me') && $currentUser->tokenCan('view.me');
        }

        // Kiểm tra xem những thông tin của người khác
        if ($currentUser->isNot($user)) {
            return $currentUser->can('view.users') && $currentUser->tokenCan('view.users');
        }

        return false;
    }

    public function create(User $currentUser): bool
    {
        return $currentUser->can('create.users') && $currentUser->tokenCan('create.users');
    }

    public function update(User $currentUser, User $user): bool
    {
        $roleOfCurrentUser = $currentUser->getRoleNames()->first();
        $roleOfUser = $user->getRoleNames()->first();

        // Tài khoản mod không thể cập nhật tài khoản admin
        if ($roleOfCurrentUser === 'mod' && $roleOfUser === 'admin') {
            return false;
        }

        return $currentUser->can('update.users') && $currentUser->tokenCan('update.users');
    }

    public function delete(User $currentUser, User $user): bool
    {
        // Không thể tự xóa tài khoản của chính mình
        if ($currentUser->is($user)) {
            return false;
        }

        $roleOfCurrentUser = $currentUser->getRoleNames()->first();
        $roleOfUser = $user->getRoleNames()->first();

        // Tài khoản mod không thể xóa tài khoản admin
        if ($roleOfCurrentUser === 'mod' && $roleOfUser === 'admin') {
            return false;
        }

        return $currentUser->can('delete.users') && $currentUser->tokenCan('delete.users');
    }
}
