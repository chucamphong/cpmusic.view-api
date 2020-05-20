<?php

namespace Tests\Unit\CategoryController;

use Tests\TestCase;

/**
 * @group CategoryController
 */
class StoreMethodTest extends TestCase
{
    /**
     * @test
     * @testdox Báo lỗi nếu chưa đăng nhập
     */
    public function bao_loi_neu_chua_dang_nhap()
    {
        $response = $this->postJson(route('categories.store'), [
            'name' => 'Nhạc Mỹ'
        ]);

        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Tạo thể loại bằng tài khoản Admin
     */
    public function tao_the_loai_voi_tai_khoan_admin()
    {
        $user = $this->createUser('admin');
        $this->login($user);

        $response = $this->postJson(route('categories.store'), [
            'name' => 'Nhạc Mỹ'
        ]);

        $response->assertOk();
    }

    /**
     * @test
     * @testdox Tạo thể loại bằng tài khoản Moderator
     */
    public function tao_the_loai_voi_tai_khoan_mod()
    {
        $user = $this->createUser('mod');
        $this->login($user);

        $response = $this->postJson(route('categories.store'), [
            'name' => 'Nhạc Mỹ'
        ]);

        $response->assertOk();
    }

    /**
     * @test
     * @testdox Báo lỗi nếu tạo thể loại bằng tài khoản Member
     */
    public function bao_loi_neu_tao_the_loai_bang_tai_khoan_member()
    {
        $user = $this->createUser();
        $this->login($user);

        $response = $this->postJson(route('categories.store'), [
            'name' => 'Nhạc Mỹ'
        ]);

        $response->assertForbidden();
    }
}
