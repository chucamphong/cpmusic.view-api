<?php

namespace Tests\Unit\UploadController;

use Illuminate\Http\Response;
use Tests\TestCase;

/**
 * @group UploadController
 */
class UploadSongTest extends TestCase
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
            'file' => $this->fakeSong(),
            'type' => 'song'
        ]);

        $response->assertUnauthorized();
    }

    /**
     * @test
     * @testdox Tải bài hát lên server
     */
    public function tai_len_bai_hat()
    {
        $user = $this->createUser();
        $this->login($user);
        $file = $this->fakeSong();

        $response = $this->postJson(route('upload'), [
            'file' => $file,
            'type' => 'song'
        ]);

        \Storage::disk()->assertExists("songs/{$file->hashName()}");

        $response->assertOk()->assertJsonStructure([
            'data' => ['base', 'path']
        ]);
    }

    /**
     * @test
     * @testdox Tải bải hát lên server nhưng để type sai
     */
    public function tai_len_bai_hat_sai_type()
    {
        $user = $this->createUser();
        $this->login($user);

        $response = $this->postJson(route('upload'), [
            'file' => $this->fakeSong(),
            'type' => 'aaa'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     * @testdox Tải bài hát lên server nhưng sai phần mở rộng
     */
    public function tai_len_anh_dai_dien_sai_phan_mo_rong()
    {
        $user = $this->createUser();
        $this->login($user);

        $response = $this->postJson(route('upload'), [
            'file' => $this->fakeSong('default.mpeg', 3000, 'audio/mp3'),
            'type' => 'song'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
