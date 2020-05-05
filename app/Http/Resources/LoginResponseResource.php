<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResponseResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var \Laravel\Sanctum\NewAccessToken|$this $this */

        return [
            'plainTextToken' => $this->plainTextToken,
            'expires' => config('sanctum.expiration')
        ];
    }
}
