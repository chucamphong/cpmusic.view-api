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
     * @testdox Lấy danh sách thể loại
     */
    public function lay_danh_sach_the_loai()
    {
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
     */
    public function lay_danh_sach_the_loai_co_phan_trang()
    {
        $response = $this->getJson(route('categories.index', 'page[number]=1'));
        $response->assertJsonStructure([
            'data',
            'links',
            'meta'
        ]);
    }

    /**
     * @test
     * @testdox Tìm kiếm thể loại
     */
    public function timKiemTheLoai()
    {
        $response = $this->getJson(route('categories.index', 'filter[name]=Nhạc trẻ'));
        $response->assertJsonFragment([
            'name' => 'Nhạc trẻ'
        ]);
    }
}
