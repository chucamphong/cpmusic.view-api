<?php

namespace Tests\Unit\CategoryController;

use Tests\TestCase;

/**
 * @group CategoryController
 */
class DeleteMethodTest extends TestCase
{
    /**
     * @test
     * @testdox Báo lỗi nếu truy cập api khi chưa đăng nhập
     */
    public function bao_loi_neu_truy_cap_api_khi_chua_dang_nhap()
    {
        $response = $this->deleteJson(route('categories.destroy', 1));
        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Xóa thể loại với tài khoản Admin
     */
    public function xoa_the_loai_voi_tai_khoan_admin()
    {
        $category = $this->createCategory();

        $user = $this->createUser('admin');
        $this->login($user);

        $response = $this->deleteJson(route('categories.destroy', $category->id));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Xóa thể loại với tài khoản Moderator
     */
    public function xoa_the_loai_voi_tai_khoan_mod()
    {
        $category = $this->createCategory();

        $user = $this->createUser('mod');
        $this->login($user);

        $response = $this->deleteJson(route('categories.destroy', $category->id));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Tài khoản member không thể xóa bài hát
     */
    public function tai_khoan_member_khong_the_xoa_bai_hat()
    {
        $category = $this->createCategory();

        $user = $this->createUser();
        $this->login($user);

        $response = $this->deleteJson(route('categories.destroy', $category->id));
        $response->assertForbidden();
    }
}
