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
     * @testdox Lấy thông tin nghệ sĩ với ID
     */
    public function lay_thong_tin_nghe_si()
    {
        $artist = $this->createArtist();
        $response = $this->getJson(route('artists.show', $artist->id));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Báo lỗi nếu ID nghệ sĩ không tồn tại
     */
    public function bao_loi_neu_nghe_si_khong_ton_tai()
    {
        $response = $this->getJson(route('artists.show', 2));
        $response->assertNotFound();
    }
}
