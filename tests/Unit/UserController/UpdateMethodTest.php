<?php

namespace Tests\Unit\UserController;

use Faker\Factory as Faker;
use Tests\TestCase;

/**
 * @group UserController
 */
class UpdateMethodTest extends TestCase
{
    /**
     * @test
     * @testdox Không được phép truy cập api cập nhật tài khoản khi chưa đăng nhập
     */
    public function khong_duoc_phep_lay_thong_tin_khi_chua_dang_nhap()
    {
        $user = $this->createUser();

        $response = $this->patchJson(route('users.update', $user->id));

        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Cập nhật thông tin tài khoản của tài khoản member
     */
    public function cap_nhat_thong_tin_tai_khoan_cua_member()
    {
        $mod = $this->createUser('mod');
        $member = $this->createUser();

        $this->login($mod);

        $response = $this->patchJson(route('users.update', $member->id), [
            'name' => 'Chu Phong',
            'password' => 'password',
            'avatar' => 'http://ac.co/asdasdsadadad',
        ]);

        $response->assertOk()->assertJsonStructure([
            'data' => ['message']
        ]);
    }

    /**
     * @test
     * @testdox Báo lỗi nếu tài khoản mod sửa thông tin tài khoản của admin
     */
    public function bao_loi_neu_tai_khoan_mod_cap_nhat_thong_tin_tai_khoan_admin()
    {
        $admin = $this->createUser('admin');
        $mod = $this->createUser('mod');

        $this->login($mod);

        $response = $this->patchJson(route('users.update', $admin->id), [
            'name' => \Str::random(8),
            'email' => 'abc@gmail.com'
        ]);

        $response->assertForbidden();
    }

    /**
     * @test
     * @testdox Báo lỗi nếu tài khoản mod sửa chức vụ của bản thân
     */
    public function bao_loi_neu_tai_khoan_mod_thay_doi_chuc_vu_tai_khoan()
    {
        $mod = $this->createUser('mod');

        $this->login($mod);

        $response = $this->patchJson(route('users.update', $mod->id), [
            'role' => 'admin'
        ]);

        $response->assertForbidden();
    }

    /**
     * @test
     * @testdox Cập nhật họ tên, password, avatar của bản thân
     * @dataProvider danhSachTaiKhoan
     * @param string $role
     */
    public function cap_nhat_ho_ten_password_avatar_cua_ban_than(string $role)
    {
        $faker = Faker::create();
        $user = $this->createUser($role);

        $this->login($user);

        $response = $this->patchJson(route('users.update', $user->id), [
            'name' => $faker->name,
            'password' => $faker->password(8),
            'avatar' => $faker->imageUrl()
        ]);

        $response->assertOk()->assertJsonStructure([
            'data' => ['message']
        ]);
    }

    public function danhSachTaiKhoan()
    {
        return [
            'Tài khoản Admin' => ['admin'],
            'Tài khoản Mod' => ['mod']
        ];
    }
}
