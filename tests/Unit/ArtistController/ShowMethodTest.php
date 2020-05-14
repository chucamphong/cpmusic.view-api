<?php

namespace Tests\Unit\ArtistController;

use Tests\TestCase;

/**
 * @group ArtistController
 */
class ShowMethodTest extends TestCase
{
    /**
     * @test
     * @testdox Báo lỗi nếu truy cập api khi chưa đăng nhập
     */
    public function bao_loi_neu_truy_cap_api_khi_chua_dang_nhap()
    {
        $artist = $this->createArtist();

        $response = $this->getJson(route('artists.show', $artist->id));

        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Báo lỗi nếu tài khoản không có permission view.artists cho dù đó là tài khoản mang chức vụ Admin
     */
    public function bao_loi_api_khi_truy_cap_khong_co_quyen()
    {
        $user = $this->createUser('admin', ['view.users']);
        $artist = $this->createArtist();

        $this->login($user, ['view.users']);

        $response = $this->getJson(route('artists.show', $artist->id));
        $response->assertForbidden();
    }

    /**
     * @test
     * @testdox Báo lỗi nếu không tìm thấy id nghệ sĩ
     */
    public function bao_loi_neu_lay_thong_tin_cua_nghe_si_chua_duoc_tao()
    {
        $user = $this->createUser();
        $this->login($user);
        $response = $this->getJson(route('artists.show', 5000));
        $response->assertNotFound();
    }

    /**
     * @test
     * @testdox Lấy thông tin nghệ sĩ
     * @dataProvider danhSachChucVu
     * @param string $role
     */
    public function lay_thong_tin_nghe_si(string $role)
    {
        $user = $this->createUser($role);
        $artist = $this->createArtist();

        $this->login($user);

        $response = $this->getJson(route('artists.show', $artist->id));
        $response->assertOk();
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
