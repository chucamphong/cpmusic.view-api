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
     * @testdox Lấy danh sách nghệ sĩ
     */
    public function lay_danh_sach_nghe_si()
    {
        $response = $this->getJson(route('artists.index'));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Lấy danh sách nghệ sĩ có phân trang
     */
    public function lay_danh_sach_nghe_si_co_phan_trang()
    {
        $response = $this->getJson(route('artists.index', 'page[number]=1'));
        $response->assertJsonStructure([
            'data',
            'links',
            'meta'
        ]);
    }

    /**
     * @test
     * @testdox Tìm kiếm nghệ sĩ
     */
    public function tim_kiem_nghe_si()
    {
        $artist = $this->createArtist();
        $response = $this->getJson(route('artists.index', "filter[name]=$artist->name"));
        $response->assertJsonFragment([
            'name' => $artist->name
        ]);
    }
}
