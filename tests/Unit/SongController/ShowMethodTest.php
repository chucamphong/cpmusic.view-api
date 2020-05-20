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
     * @testdox Lấy thông tin bài hát có ID là 1
     */
    public function lay_thong_tin_bai_hat_co_id_la_1()
    {
        $song = $this->createSong();
        $response = $this->getJson(route('songs.show', $song->id));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Lấy thông tin bài hát có ID là ngẫu nhiên (không tồn tại)
     */
    public function lay_thong_tin_bai_hat_co_id_la_ngau_nhien()
    {
        $response = $this->getJson(route('songs.show', 1000));
        $response->assertNotFound();
    }
}
