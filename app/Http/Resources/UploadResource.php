<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UploadResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'base' => asset(\Storage::url(null)),
            'path' => $this['url']
        ];
    }
}
