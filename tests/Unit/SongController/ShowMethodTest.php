<?php

namespace Tests\Unit\SongController;

use Tests\TestCase;

/**
 * @group SongController
 */
class ShowMethodTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\CategoriesTableSeeder::class);
    }

    /**
     * @test
     * @testdox Báo lỗi truy cập api nếu chưa đăng nhập
     */
    public function bao_loi_neu_truy_cap_api_khi_chua_dang_nhap()
    {
        $response = $this->getJson(route('songs.show', 1));

        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Báo lỗi truy cập nếu không có quyền view.songs
     */
    public function bao_loi_neu_khong_co_quyen()
    {
        $user = $this->createUser('member', ['view.users']);
        $song = $this->createSong();
        $this->login($user, ['view.users']);
        $response = $this->getJson(route('songs.show', $song->id));
        $response->assertForbidden();
    }

    /**
     * @test
     * @testdox Lấy thông tin bài hát với quyền view.songs không thông qua chức vụ
     */
    public function lay_danh_sach_bai_hat_gan_bang_permission()
    {
        $user = $this->createUser('member', ['view.songs']);
        $song = $this->createSong();
        $this->login($user, ['view.songs']);
        $response = $this->getJson(route('songs.show', $song->id));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Lấy thông tin bài hát bằng tài khoản có chức vụ Admin
     */
    public function lay_danh_sach_bai_hat_bang_tai_khoan_co_chuc_vu_admin()
    {
        $user = $this->createUser('admin');
        $this->login($user);
        $song = $this->createSong();
        $response = $this->getJson(route('songs.show', $song->id));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Lấy thông tin bài hát bằng tài khoản có chức vụ mod
     */
    public function lay_danh_sach_bai_hat_bang_tai_khoan_co_chuc_vu_mod()
    {
        $user = $this->createUser('mod');
        $this->login($user);
        $song = $this->createSong();
        $response = $this->getJson(route('songs.show', $song->id));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Lấy thông tin bài hát bằng tài khoản có chức vụ member
     */
    public function lay_danh_sach_bai_hat_bang_tai_khoan_co_chuc_vu_member()
    {
        $user = $this->createUser('member');
        $this->login($user);
        $song = $this->createSong();
        $response = $this->getJson(route('songs.show', $song->id));
        $response->assertOk();
    }
}
