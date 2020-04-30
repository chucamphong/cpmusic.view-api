<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\RolesAndPermissionsSeeder::class);
    }

    protected function getAbilities(User $user)
    {
        return $user->getPermissionsViaRoles()->map(function ($permission) {
            return $permission['name'];
        })->all();
    }

    protected function login(User $user, $abilities = [])
    {
        if (empty($abilities)) {
            Sanctum::actingAs($user, $this->getAbilities($user) ?? []);
        } else {
            Sanctum::actingAs($user, $abilities);
        }
    }

    protected function createUser($role = 'member', $permissions = [])
    {
        if (empty($permissions)) {
            return factory(User::class)->create()->assignRole($role);
        } else {
            return factory(User::class)->create()->givePermissionTo($permissions);
        }
    }
}
