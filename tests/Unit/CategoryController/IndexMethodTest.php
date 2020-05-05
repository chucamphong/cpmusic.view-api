<?php

namespace Tests\Unit\CategoryController;

use Tests\TestCase;

/**
 * @group CategoryController
 */
class IndexMethodTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\CategoriesTableSeeder::class);
    }

    /**
     * @test
     * @testdox Báo lỗi nếu truy cập api khi chưa đăng nhập
     */
    public function bao_loi_neu_truy_cap_api_khi_chua_dang_nhap()
    {
        $response = $this->getJson(route('categories.index'));

        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Báo lỗi nếu tài khoản không có permission view.categories cho dù đó là tài khoản mang chức vụ Admin
     */
    public function bao_loi_api_khi_truy_cap_khong_co_quyen()
    {
        $user = $this->createUser('admin', ['view.songs']);
        $this->login($user, ['view.songs']);
        $response = $this->getJson(route('categories.index'));
        $response->assertForbidden();
    }

    /**
     * @test
     * @testdox Lấy danh sách thể loại
     * @dataProvider danhSachChucVu
     * @param string $role
     */
    public function lay_danh_sach_the_loai(string $role)
    {
        $user = $this->createUser($role);
        $this->login($user);
        $response = $this->getJson(route('categories.index'));
        $response->assertJsonStructure([
            'data' => [
                ['id', 'name', 'created_at', 'updated_at']
            ]
        ]);
    }

    /**
     * @test
     * @testdox Lấy danh sách thể loại có phân trang
     * @dataProvider danhSachChucVu
     * @param string $role
     */
    public function lay_danh_sach_the_loai_co_phan_trang(string $role)
    {
        $user = $this->createUser($role);
        $this->login($user);
        $response = $this->getJson(route('categories.index', 'page[number]=1'));
        $response->assertJsonStructure([
            'data',
            'links',
            'meta'
        ]);
    }

    /**
     * @test
     * @testdox Lấy danh sách thể loại với tài khoản có permission được gán thẳng không thông qua chức vụ
     */
    public function lay_danh_sach_the_loai_gan_bang_permission()
    {
        $user = $this->createUser('member', ['view.categories']);
        $this->login($user, ['view.categories']);
        $response = $this->getJson(route('categories.index'));
        $response->assertJsonStructure([
            'data' => [
                ['id', 'name', 'created_at', 'updated_at']
            ]
        ]);
    }

    /**
     * @test
     * @testdox Tìm kiếm thể loại
     */
    public function timKiemTheLoai()
    {
        $user = $this->createUser();
        $this->login($user);
        $response = $this->getJson(route('categories.index', 'filter[name]=Nhạc trẻ'));
        $response->assertJsonFragment([
            'name' => 'Nhạc trẻ'
        ]);
    }

    public function danhSachChucVu()
    {
        return [
            "Tài khoản Admin" => ["admin"],
            "Tài khoản Mod" => ["mod"],
            "Tài khoản Member" => ["member"],
        ];
    }
}
