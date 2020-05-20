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
     * @testdox Lấy danh sách bài hát
     */
    public function lay_danh_sach_bai_hat()
    {
        $response = $this->getJson(route('songs.index'));
        $response->assertOk();
    }
}
