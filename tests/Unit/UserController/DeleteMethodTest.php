<?php

namespace Tests\Unit\UserController;

use App\Models\User;
use Tests\TestCase;

/**
 * @group UserController
 */
class DeleteMethodTest extends TestCase
{
    /**
     * @test
     * @testdox Không thể truy cập vào API xóa tài khoản nếu chưa đăng nhập
     */
    public function khong_the_truy_cap_neu_chua_dang_nhap()
    {
        $user = $this->createUser('admin');

        $response = $this->deleteJson(route('users.destroy', $user->id));

        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Không thể tự xóa tài khoản của chính mình
     */
    public function khong_the_tu_xoa_tai_khoan_cua_chinh_minh()
    {
        $user = $this->createUser('admin');

        $this->login($user);

        $response = $this->deleteJson(route('users.destroy', $user->id));

        $response->assertForbidden();
    }

    public function danhSachTaiKhoanAdminVoiCacTaiKhoanCoChucVuKhac()
    {
        $this->refreshApplication();

        return [
            // Tài khoản có chức vụ Admin xóa các tài khoản khác có chức vụ khác nhau
            'Admin xóa Admin' => [factory(User::class)->make(), 'admin', factory(User::class)->make(), 'admin'],
            'Admin xóa Mod' => [factory(User::class)->make(), 'admin', factory(User::class)->make(), 'mod'],
            'Admin xóa Member' => [factory(User::class)->make(), 'admin', factory(User::class)->make(), 'member'],
        ];
    }

    /**
     * @test
     * @testdox Tài khoản quyền Admin xóa các tài khoản có quyền khác bao gồm cả tài khoản có quyền Admin
     * @dataProvider danhSachTaiKhoanAdminVoiCacTaiKhoanCoChucVuKhac
     * @param User $user
     * @param string $role
     * @param User $otherUser
     * @param string $otherRole
     */
    public function tai_khoan_co_quyen_admin_xoa_tai_khoan_khac(User $user, string $role, User $otherUser, string $otherRole)
    {
        $user->assignRole($role)->save();
        $otherUser->assignRole($otherRole)->save();

        $this->login($user);

        $response = $this->deleteJson(route('users.destroy', $otherUser->id));

        $response->assertOk()->assertJsonStructure(['message']);
    }

    /**
     * @test
     * @testdox Tài khoản có quyền Mod không được phép xóa tài khoản có quyền Admin
     */
    public function tai_khoan_mod_khong_duoc_xoa_tai_khoan_admin()
    {
        $mod = $this->createUser('mod');
        $admin = $this->createUser('admin');

        $this->login($mod);

        $response = $this->deleteJson(route('users.destroy', $admin->id));

        $response->assertForbidden()->assertJsonStructure([
            'data' => ['message']
        ]);
    }

    public function danhSachTaiKhoanModVoiCacTaiKhoanCoChucVuKhac()
    {
        $this->refreshApplication();

        return [
            // Tài khoản có chức vụ Admin xóa các tài khoản khác có chức vụ khác nhau (Không được phép xóa Admin)
            'Mod xóa Mod' => [factory(User::class)->make(), 'admin', factory(User::class)->make(), 'mod'],
            'Mod xóa Member' => [factory(User::class)->make(), 'admin', factory(User::class)->make(), 'member'],
        ];
    }

    /**
     * @test
     * @testdox Tài khoản quyền Mod xóa các tài khoản có quyền khác (không bao gồm Admin)
     * @dataProvider danhSachTaiKhoanModVoiCacTaiKhoanCoChucVuKhac
     * @param User $user
     * @param string $role
     * @param User $otherUser
     * @param string $otherRole
     */
    public function tai_khoan_co_quyen_mod_xoa_tai_khoan_khac(User $user, string $role, User $otherUser, string $otherRole)
    {
        $user->assignRole($role)->save();
        $otherUser->assignRole($otherRole)->save();

        $this->login($user);

        $response = $this->deleteJson(route('users.destroy', $otherUser->id));

        $response->assertOk()->assertJsonStructure(['message']);
    }

    /**
     * @test
     * @testdox Tài khoản thường không được phép truy cập
     */
    public function tai_khoan_member_khong_duoc_phep_truy_cap()
    {
        $member = $this->createUser('member');
        $otherMember = $this->createUser('member');

        $this->login($member);

        $response = $this->deleteJson(route('users.destroy', $otherMember->id));

        $response->assertForbidden();
    }
}
