<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Mọi tài khoản đều có thể xem tất cả thể loại (không cần phải đăng nhập)
     * @param User $user
     * @return bool
     * @noinspection PhpUnused
     * @noinspection PhpUnusedParameterInspection
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Mọi tài khoản đều có thể xem thông tin thể loại dựa trên ID
     * @param User $user
     * @param Category $category
     * @return bool
     * @noinspection PhpUnused
     * @noinspection PhpUnusedParameterInspection
     */
    public function view(?User $user, Category $category): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create.categories') && $user->tokenCan('create.categories');
    }

    /**
     * @param User $user
     * @param Category $category
     * @return bool
     * @noinspection PhpUnusedParameterInspection
     */
    public function update(User $user, Category $category): bool
    {
        return $user->can('update.categories') && $user->tokenCan('update.categories');
    }

    /**
     * @param User $user
     * @param Category $category
     * @return bool
     * @noinspection PhpUnusedParameterInspection
     */
    public function delete(User $user, Category $category)
    {
        return $user->can('delete.categories') && $user->tokenCan('delete.categories');
    }
}
