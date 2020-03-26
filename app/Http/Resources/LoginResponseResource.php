<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Airlock\NewAccessToken;

class LoginResponseResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var NewAccessToken $this */

        return [
            'plainTextToken' => $this->plainTextToken,
//            'abilities' => $this->accessToken['abilities'],
            'expires' => config('airlock.expiration')
        ];
    }
}
