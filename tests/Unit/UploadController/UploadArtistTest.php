<?php

namespace Tests\Unit\UploadController;

use Illuminate\Http\Response;
use Tests\TestCase;

/**
 * @group UploadController
 */
class UploadArtistTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        \Storage::fake();
    }

    /**
     * @test
     * @testdox Báo lỗi nếu chưa đăng nhập
     */
    public function bao_loi_khi_chua_dang_nhap()
    {
        $response = $this->postJson(route('upload'), [
            'file' => $this->createImage(),
            'type' => 'artist'
        ]);

        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Tải ảnh đại diện lên server
     */
    public function tai_len_anh_dai_dien()
    {
        $user = $this->createUser();
        $this->login($user);
        $file = $this->createImage();

        $response = $this->postJson(route('upload'), [
            'file' => $file,
            'type' => 'artist'
        ]);

        \Storage::disk()->assertExists("avatars/artists/{$file->hashName()}");

        $response->assertOk()->assertJsonStructure([
            'data' => ['base', 'path']
        ]);
    }

    /**
     * @test
     * @testdox Tải ảnh đại diện lên server nhưng để type sai
     */
    public function tai_len_anh_dai_dien_sai_type()
    {
        $user = $this->createUser();
        $this->login($user);

        $response = $this->postJson(route('upload'), [
            'file' => $this->createImage(),
            'type' => 'aaa'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     * @testdox Tải ảnh đại diện lên server nhưng sai phần mở rộng
     */
    public function tai_len_anh_dai_dien_sai_phan_mo_rong()
    {
        $user = $this->createUser();
        $this->login($user);

        $response = $this->postJson(route('upload'), [
            'file' => $this->createImage("default", "gif"),
            'type' => 'user'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
