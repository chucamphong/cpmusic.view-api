<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Upload\Request as UploadRequest;
use App\Http\Resources\UploadResource;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;

class UploadController extends Controller
{
    /**
     * @param UploadRequest $request
     * @return UploadResource|\Illuminate\Http\JsonResponse
     */
    public function upload(UploadRequest $request)
    {
        $file = $request->file('file');
        $type = $request->get('type');

        if ($this->isImage($file)) {
            return $this->saveImage($file, $type);
        }

        if ($this->isSong($file)) {
            return $this->saveSong($file, $type);
        }

        return response()->json([
            'data' => [
                'message' => 'Không hỗ trợ tải lên tệp tin này'
            ]
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Lưu hình ảnh
     * @param UploadedFile|UploadedFile[]|array|null $file
     * @param string $type
     * @return UploadResource|\Illuminate\Http\JsonResponse
     */
    private function saveImage($file, string $type)
    {
        $type = \Str::of($type);

        if ($type->is('user')) {
            return $this->save('avatars/users', $file);
        }

        if ($type->is('artist')) {
            return $this->save('avatars/artists', $file);
        }

        if ($type->is('thumbnail')) {
            return $this->save('songs/thumbnails', $file);
        }

        return response()->json([
            'data' => [
                'message' => 'Loại file không hợp lệ'
            ]
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Lưu bài hát
     * @param UploadedFile|UploadedFile[]|array|null $file
     * @param string $type
     * @return UploadResource|\Illuminate\Http\JsonResponse
     */
    private function saveSong($file, string $type)
    {
        $type = \Str::of($type);

        if ($type->is('song')) {
            return $this->save('songs', $file);
        }

        return response()->json([
            'data' => [
                'message' => 'Loại file không hợp lệ'
            ]
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Lưu tệp tin
     * @param string $path
     * @param UploadedFile|UploadedFile[] $file
     * @return UploadResource
     */
    private function save(string $path, $file): UploadResource
    {
        $path = $file->store($path);

        return new UploadResource([
            'url' => $path
        ]);
    }

    /**
     * Kiểm tra tệp tin có phải là hình ảnh
     * @param UploadedFile|UploadedFile[]|array|null $file
     * @return bool
     */
    private function isImage($file): bool
    {
        $extensions = ['jpeg', 'jpg', 'jpe', 'png'];
        return in_array($file->extension(), $extensions);
    }

    /**
     * Kiểm tra tệp tin có phải là bài hát
     * @param UploadedFile|UploadedFile[]|array|null $file
     * @return bool
     */
    private function isSong($file): bool
    {
        $extensions = ['mpga', 'mp2', 'mp2a', 'mp3', 'm2a', 'm3a'];
        return in_array($file->extension(), $extensions);
    }
}
