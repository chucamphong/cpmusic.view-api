<?php

namespace Tests\Unit\CategoryController;

use Tests\TestCase;

/**
 * @group CategoryController
 */
class ShowMethodTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @testdox Lấy thể loại có ID là 1
     */
    public function lay_thong_tin_the_loai_co_id_la_1()
    {
        $category = $this->createCategory();

        $response = $this->getJson(route('categories.show', $category->id));
        $response->assertOk();
    }

    /**
     * @test
     * @testdox Lấy thể loại có ID không tồn tại trong csdl
     */
    public function lay_thong_tin_the_loai_co_id_khong_ton_tai()
    {
        $response = $this->getJson(route('categories.show', 2));
        $response->assertNotFound();
    }
}
