<?php

namespace App\Http\Resources;

use App\Models\Song;
use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Song|$this $this */

        return [
            $this->mergeWhen($this->id, [
                'id' => $this->id
            ]),
            $this->mergeWhen($this->name, [
                'name' => $this->name
            ]),
            $this->mergeWhen($this->other_name, [
                'other_name' => $this->other_name
            ]),
            $this->mergeWhen($this->thumbnail, [
                'thumbnail' => asset(\Storage::url($this->thumbnail))
            ]),
            $this->mergeWhen($this->url, [
                'url' => asset(\Storage::url($this->url)),
            ]),
            $this->mergeWhen($this->year, [
                'year' => $this->year
            ]),
            $this->mergeWhen($this->views, [
                'views' => $this->views
            ]),
            $this->mergeWhen($this->category, [
                'category' => $this->category
            ]),
            $this->mergeWhen($this->artists, [
                'artists' => $this->artists->each(function ($artist) {
                    unset($artist['pivot']);
                    return $artist;
                })
            ])
        ];
    }
}
