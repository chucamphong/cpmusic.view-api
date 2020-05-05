<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtistResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var \App\Models\Artist|$this $this */

        return [
            $this->mergeWhen($this->id, [
                'id' => $this->id,
            ]),
            $this->mergeWhen($this->name, [
                'name' => $this->name,
            ]),
            $this->mergeWhen($this->avatar, [
                'avatar' => asset(\Storage::url($this->avatar))
            ])
        ];
    }
}
