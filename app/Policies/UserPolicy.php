<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('view.users') && $user->tokenCan('view.users');
    }

    public function view(User $currentUser, User $user)
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

    public function create(User $user)
    {
        //
    }

    public function update(User $currentUser, User $user)
    {
        $roleOfCurrentUser = $currentUser->getRoleNames()->first();
        $roleOfUser = $user->getRoleNames()->first();

        // Tài khoản mod không thể cập nhật tài khoản admin
        if ($roleOfCurrentUser === 'mod' && $roleOfUser === 'admin') {
            return false;
        }

        return $currentUser->can('update.users') && $currentUser->tokenCan('update.users');
    }

    public function delete(User $currentUser, User $user)
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
