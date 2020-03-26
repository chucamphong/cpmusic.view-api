<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var User $this */

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'role' => $this->getRoleNames()->first(),
            'permissions' => $this->getAllPermissions()->map(function ($value) {
                [$actions, $subject] = \Str::of($value['name'])->explode('.');

                return [
                    'actions' => $actions,
                    'subject' => $subject
                ];

            })->all()
        ];
    }
}
