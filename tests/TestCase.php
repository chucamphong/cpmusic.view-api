<?php

namespace Tests;

use App\Models\Artist;
use App\Models\Category;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\UploadedFile;
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

    /**
     * Lấy những quyền hạn từ chức vụ của tài khoản
     * @param User $user Tài khoản
     * @return array Danh sách quyền hạn của tài khoản
     */
    protected function getAbilities(User $user): array
    {
        return $user->getPermissionsViaRoles()
                ->map(function ($permission) {
                    return $permission['name'];
                })->all() ?? [];
    }

    /**
     * Thực hiện đăng nhập với $user
     * Nếu muốn thay đổi quyền của $user đó thì có thể thêm vào ở tham số thứ 2
     * @param User $user Tài khoản
     * @param array $abilities Quyền hạn
     * @return \Illuminate\Contracts\Auth\Authenticatable|\Laravel\Sanctum\HasApiTokens
     */
    protected function login(User $user, $abilities = [])
    {
        $abilities = empty($abilities) ? $this->getAbilities($user) : $abilities;

        return Sanctum::actingAs($user, $abilities);
    }

    /**
     * Tạo tài khoản, mặc định sẽ là tài khoản có chức vụ Member
     * Nếu muốn thay đổi quyền có thể thêm vào ở tham số thứ 2
     * @param string $role Chức vụ
     * @param array $permissions Quyền hạn
     * @return User Tài khoản
     */
    protected function createUser($role = 'member', $permissions = []): User
    {
        $user = factory(User::class);

        return empty($permissions) ?
            $user->create()->assignRole($role) :
            $user->create()->givePermissionTo($permissions);
    }

    /**
     * Tạo thể loại
     * @param string $name Tên thể loại
     * @return Category Thể loại
     */
    protected function createCategory(string $name = ""): Category
    {
        $category = factory(Category::class);
        return empty($name) ? $category->create() : $category->create(['name' => $name]);
    }

    /**
     * Tạo ca sĩ
     * @param array $attributes Thông số cần tùy chỉnh của ca sĩ
     * @return Artist Ca sĩ
     */
    protected function createArtist(array $attributes = []): Artist
    {
        $artist = factory(Artist::class);
        return empty($attributes) ? $artist->create() : $artist->create($attributes);
    }

    /**
     * Tạo bài hát
     * @param array $attributes Thông số cần tùy chỉnh của bài hát
     * @param array $artists Danh sách ca sĩ
     * @return Song|Song[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    protected function createSong(array $attributes = [], array ...$artists)
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

    /**
     * Tạo hình ảnh
     * @param string $name
     * @param string $extension
     * @param int $width
     * @param int $height
     * @return \Illuminate\Http\Testing\File
     */
    protected function fakeImage(string $name = 'default', string $extension = 'jpg', int $width = 10, int $height = 10)
    {
        $fileName = "$name.$extension";
        return UploadedFile::fake()->image($fileName, $width, $height);
    }

    protected function fakeSong(string $name = 'default.mp3', $kilobytes = 0, string $mimeType = 'audio/mpeg')
    {
        return UploadedFile::fake()->create($name, $kilobytes, $mimeType);
    }
}
