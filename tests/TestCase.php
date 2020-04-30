<?php

namespace Tests;

use App\Models\Artist;
use App\Models\Category;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    protected function getAbilities(User $user): array
    {
        return $user->getPermissionsViaRoles()
                ->map(function ($permission) {
                    return $permission['name'];
                })->all() ?? [];
    }

    protected function login(User $user, $abilities = [])
    {
        $abilities = empty($abilities) ? $this->getAbilities($user) : $abilities;

        return Sanctum::actingAs($user, $abilities);
    }

    protected function createUser($role = 'member', $permissions = []): User
    {
        $user = factory(User::class);

        return empty($permissions) ?
            $user->create()->assignRole($role) :
            $user->create()->givePermissionTo($permissions);
    }

    protected function createCategory(string $name = ""): Category
    {
        $category = factory(Category::class);
        return empty($name) ? $category->create() : $category->create(['name' => $name]);
    }

    protected function createArtist(array $attributes = []): Artist
    {
        $artist = factory(Artist::class);
        return empty($attributes) ? $artist->create() : $artist->create($attributes);
    }

    protected function createSong(array $attributes = [], ...$artists)
    {
        if (isset($attributes['category'])) {
            $category = $this->createCategory($attributes['category']);
            unset($attributes['category']);
        } else {
            $category = $this->createCategory();
        }

        $artists = collect($artists)
            ->flatten()
            ->map(function ($artist) {
                if (empty($artist)) {
                    return false;
                }

                try {
                    return Artist::firstOrFail(['name' => $artist]);
                } catch (ModelNotFoundException $exception) {
                    return factory(Artist::class)->create(['name' => $artist]);
                }
            })
            ->filter(function ($artist) {
                return $artist instanceof Artist;
            })
            ->map->id
            ->all();

        $song = factory(Song::class)->create(array_merge($attributes, [
            "category_id" => $category->id
        ]));

        $song->artists()->sync($artists);

        return $song;
    }
}
