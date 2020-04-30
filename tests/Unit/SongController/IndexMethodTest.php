<?php

namespace Tests\Unit\SongController;

use Tests\TestCase;

/**
 * @group SongController
 */
class IndexMethodTest extends TestCase
{
    /**
     * @test
     * @testdox Báo lỗi truy cập api nếu chưa đăng nhập
     */
    public function bao_loi_neu_truy_cap_api_khi_chua_dang_nhap()
    {
        $response = $this->getJson(route('songs.index'));
        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Báo lỗi truy cập nếu không có quyền view.songs
     */
    public function bao_loi_neu_khong_co_quyen()
    {
        $user = $this->createUser('member', ['view.users']);
        $this->login($user, ['view.users']);
        $response = $this->getJson(route('songs.index'));
        $response->assertForbidden();
    }

    /**
     * @test
     * @testdox Lấy danh sách bài hát với quyền view.songs không thông qua chức vụ
     */
    public function lay_danh_sach_bai_hat_gan_bang_permission()
    {
        $user = $this->createUser('mod', ['view.songs']);
        $this->login($user, ['view.songs']);
        $response = $this->getJson(route('songs.index'));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Lấy danh sách bài hát bằng tài khoản có chức vụ Admin
     */
    public function lay_danh_sach_bai_hat_bang_tai_khoan_co_chuc_vu_admin()
    {
        $user = $this->createUser('admin');
        $this->login($user);
        $response = $this->getJson(route('songs.index'));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Lấy danh sách bài hát bằng tài khoản có chức vụ Mod
     */
    public function lay_danh_sach_bai_hat_bang_tai_khoan_co_chuc_vu_mod()
    {
        $user = $this->createUser('mod');
        $this->login($user);
        $response = $this->getJson(route('songs.index'));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Lấy danh sách bài hát bằng tài khoản có chức vụ Member
     */
    public function lay_danh_sach_bai_hat_bang_tai_khoan_co_chuc_vu_member()
    {
        $user = $this->createUser();
        $this->login($user);
        $response = $this->getJson(route('songs.index'));
        $response->assertOk();
    }
}
