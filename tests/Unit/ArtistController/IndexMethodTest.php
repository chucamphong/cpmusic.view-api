<?php

namespace Tests\Unit\ArtistController;

use Tests\TestCase;

/**
 * @group ArtistController
 */
class IndexMethodTest extends TestCase
{
    /**
     * @test
     * @testdox Báo lỗi nếu truy cập api khi chưa đăng nhập
     */
    public function bao_loi_neu_truy_cap_api_khi_chua_dang_nhap()
    {
        $response = $this->getJson(route('artists.index'));

        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Báo lỗi nếu tài khoản không có permission view.artists cho dù đó là tài khoản mang chức vụ Admin
     */
    public function bao_loi_api_khi_truy_cap_khong_co_quyen()
    {
        $user = $this->createUser('admin', ['view.users']);
        $this->login($user, ['view.users']);
        $response = $this->getJson(route('artists.index'));
        $response->assertForbidden();
    }

    /**
     * @test
     * @testdox Lấy danh sách nghệ sĩ với tài khoản Admin
     */
    public function lay_danh_sach_nghe_si_voi_tai_khoan_admin()
    {
        $user = $this->createUser('admin');
        $this->login($user);
        $response = $this->getJson(route('artists.index'));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Lấy danh sách nghệ sĩ với tài khoản Mod
     */
    public function lay_danh_sach_nghe_si_voi_tai_khoan_mod()
    {
        $user = $this->createUser('mod');
        $this->login($user);
        $response = $this->getJson(route('artists.index'));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Lấy danh sách nghệ sĩ với tài khoản Member
     */
    public function lay_danh_sach_nghe_si_voi_tai_khoan_member()
    {
        $user = $this->createUser('member');
        $this->login($user);
        $response = $this->getJson(route('artists.index'));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Lấy danh sách nghệ sĩ với tài khoản có permission được gán thẳng không thông qua role
     */
    public function lay_danh_sach_nghe_si_gan_bang_permission()
    {
        $user = $this->createUser('member', ['view.artists']);
        $this->login($user, ['view.artists']);
        $response = $this->getJson(route('artists.index'));
        $response->assertOk();
    }
}
