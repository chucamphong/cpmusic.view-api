<?php

namespace Tests\Unit\SongController;

use Tests\TestCase;

/**
 * @group SongController
 */
class DeleteMethodTest extends TestCase
{
    /**
     * @test
     * @testdox Báo lỗi truy cập api nếu chưa đăng nhập
     */
    public function bao_loi_neu_truy_cap_api_khi_chua_dang_nhap()
    {
        $song = $this->createSong();
        $response = $this->deleteJson(route('songs.destroy', $song->id));
        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Báo lỗi truy cập nếu không có quyền delete.songs
     */
    public function bao_loi_neu_khong_co_quyen()
    {
        $user = $this->createUser('member', ['delete.users']);
        $song = $this->createSong();
        $this->login($user, ['delete.users']);
        $response = $this->deleteJson(route('songs.destroy', $song->id));
        $response->assertForbidden();
    }

    /**
     * @test
     * @testdox Xóa bài hát với quyền delete.songs không thông qua chức vụ
     */
    public function xoa_bai_hat_gan_bang_permission()
    {
        $user = $this->createUser('mod', ['delete.songs']);
        $song = $this->createSong();
        $this->login($user, ['delete.songs']);
        $response = $this->deleteJson(route('songs.destroy', $song->id));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Xóa bài hát bằng tài khoản có chức vụ Admin
     */
    public function xoa_bai_hat_bang_tai_khoan_co_chuc_vu_admin()
    {
        $user = $this->createUser('admin');
        $song = $this->createSong();
        $this->login($user);
        $response = $this->deleteJson(route('songs.destroy', $song->id));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Xóa bài hát bằng tài khoản có chức vụ mod
     */
    public function xoa_bai_hat_bang_tai_khoan_co_chuc_vu_Mod()
    {
        $user = $this->createUser('mod');
        $song = $this->createSong();
        $this->login($user);
        $response = $this->deleteJson(route('songs.destroy', $song->id));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Báo lỗi nếu xóa bài hát bằng tài khoản có chức vụ member
     */
    public function bao_loi_neu_xoa_bai_hat_bang_tai_khoan_co_chuc_vu_member()
    {
        $user = $this->createUser();
        $song = $this->createSong();
        $this->login($user);
        $response = $this->deleteJson(route('songs.destroy', $song->id));
        $response->assertForbidden();
    }
}
