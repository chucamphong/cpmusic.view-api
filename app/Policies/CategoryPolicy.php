<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /** @noinspection PhpUnused */
    public function viewAny(User $user)
    {
        return $user->can('view.categories') && $user->tokenCan('view.categories');
    }

    /** @noinspection PhpUnusedParameterInspection */
    public function view(User $user, Category $category)
    {
        return $user->can('view.categories') && $user->tokenCan('view.categories');
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Category $category)
    {
        //
    }

    public function delete(User $user, Category $category)
    {
        //
    }

    public function restore(User $user, Category $category)
    {
        //
    }

    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
