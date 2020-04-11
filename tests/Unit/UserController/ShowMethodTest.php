<?php

namespace Tests\Unit\UserController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShowMethodTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\RolesAndPermissionsSeeder::class);
    }

    /**
     * @test
     * @testdox Không được phép lấy thông tin tài khoản khi chưa đăng nhập
     */
    public function khong_duoc_phep_lay_thong_tin_khi_chua_dang_nhap()
    {
        $user = factory(User::class)->create()->assignRole('member');

        $response = $this->getJson(route('users.show', $user->id));

        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Xem được thông tin tài khoản của bản thân với id là "me"
     */
    public function co_the_lay_thong_tin_cua_ban_than_sau_khi_dang_nhap_voi_id_la_me()
    {
        $user = factory(User::class)->create()->assignRole('member');

        $abilities = $user->getPermissionsViaRoles()->map(function ($permission) {
            return $permission['name'];
        })->all();

        Sanctum::actingAs($user, $abilities);

        $response = $this->getJson(route('users.show', $user->id));

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'role',
                    'permissions'
                ]
            ]);
    }

    /**
     * @test
     * @testdox Xem được thông tin tài khoản của bản thân với id của tài khoản
     */
    public function co_the_lay_thong_tin_cua_ban_than_sau_khi_dang_nhap_voi_id_cua_tai_khoan()
    {
        $user = factory(User::class)->create()->assignRole('member');

        $abilities = $user->getPermissionsViaRoles()->map(function ($permission) {
            return $permission['name'];
        })->all();

        Sanctum::actingAs($user, $abilities);

        $response = $this->getJson(route('users.show', 'me'));

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'role',
                    'permissions'
                ]
            ]);
    }

    /**
     * @test
     * @testdox Tài khoản có chức vụ A (Admin, Mod) có thể thực hiện xem thông tin tài khoản có chức vụ B
     * @dataProvider danhSachCacTaiKhoanCoChucVuAvoiB
     * @param User $currentUser
     * @param string $role
     * @param User $otherUser
     * @param string $otherRole
     */
    public function tai_khoan_co_chuc_vu_Mod_va_Admin_co_the_the_xem_thong_tin_cua_tai_khoan_co_chuc_vu_B(User $currentUser, string $role, User $otherUser, string $otherRole)
    {
        $currentUser->assignRole($role)->save();
        $otherUser->assignRole($otherRole)->save();

        $abilities = $currentUser->getPermissionsViaRoles()->map(function ($permission) {
            return $permission['name'];
        })->all();

        Sanctum::actingAs($currentUser, $abilities);

        $response = $this->getJson(route('users.show', $otherUser->id));

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'role',
                    'permissions'
                ]
            ]);
    }

    /**
     * @test
     * @testdox Tài khoản có chức vụ Member không thể thực hiện xem thông tin tài khoản có chức vụ khác
     * @dataProvider danhSachCacTaiKhoanCoChucVuMembervoiB
     * @param User $currentUser
     * @param string $role
     * @param User $otherUser
     * @param string $otherRole
     */
    public function tai_khoan_co_chuc_vu_Member_khong_the_the_xem_thong_tin_cua_tai_khoan_co_chuc_vu_khac(User $currentUser, string $role, User $otherUser, string $otherRole)
    {
        $currentUser->assignRole($role)->save();
        $otherUser->assignRole($otherRole)->save();

        $abilities = $currentUser->getPermissionsViaRoles()->map(function ($permission) {
            return $permission['name'];
        })->all();

        Sanctum::actingAs($currentUser, $abilities);

        $response = $this->getJson(route('users.show', $otherUser->id));

        $response->assertForbidden();
    }

    public function danhSachCacTaiKhoanCoChucVuAvoiB()
    {
        $this->refreshApplication();

        return [
            // Tài khoản có chức vụ Mod xem thông tin tài khoản của các chức vụ khác
            'Mod xem Member' => [factory(User::class)->make(), 'mod', factory(User::class)->make(), 'member'],
            'Mod xem Mod' => [factory(User::class)->make(), 'mod', factory(User::class)->make(), 'mod'],
            'Mod xem Admin' => [factory(User::class)->make(), 'mod', factory(User::class)->make(), 'admin'],

            // Tài khoản có chức vụ Admin xem thông tin tài khoản của các chức vụ khác
            'Admin xem Member' => [factory(User::class)->make(), 'admin', factory(User::class)->make(), 'member'],
            'Admin xem Mod' => [factory(User::class)->make(), 'admin', factory(User::class)->make(), 'mod'],
            'Admin xem Admin' => [factory(User::class)->make(), 'admin', factory(User::class)->make(), 'admin'],
        ];
    }

    public function danhSachCacTaiKhoanCoChucVuMembervoiB()
    {
        $this->refreshApplication();

        return [
            // Tài khoản có chức vụ Member xem thông tin tài khoản của các chức vụ khác
            'Member xem Member' => [factory(User::class)->make(), 'member', factory(User::class)->make(), 'member'],
            'Member xem Mod' => [factory(User::class)->make(), 'member', factory(User::class)->make(), 'mod'],
            'Member xem Admin' => [factory(User::class)->make(), 'member', factory(User::class)->make(), 'admin'],
        ];
    }
}
