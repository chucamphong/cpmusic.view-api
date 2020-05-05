<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Upload\AvatarRequest;
use App\Http\Resources\UploadResource;

class UploadController extends Controller
{
    private function save($path, $file)
    {
        $path = $file->store($path);

        return new UploadResource([
            'url' => $path
        ]);
    }

    private function avatar(AvatarRequest $request, string $path): UploadResource
    {
        $file = $request->file('file');
        return $this->save('avatars/' . $path, $file);
    }

    /**
     * Lưu hình đại diện của tài khoản
     * @param AvatarRequest $request
     * @return UploadResource
     * @noinspection PhpUnused
     */
    public function userAvatar(AvatarRequest $request): UploadResource
    {
        return $this->avatar($request, 'users');
    }
}
