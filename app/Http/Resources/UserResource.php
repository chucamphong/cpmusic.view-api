<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var \App\Models\User|$this $this */

        return [
            $this->mergeWhen($this->id, [
                'id' => $this->id
            ]),
            $this->mergeWhen($this->name, [
                'name' => $this->name
            ]),
            $this->mergeWhen($this->email, [
                'email' => $this->email
            ]),
            $this->mergeWhen($this->avatar, [
                'avatar' => $this->avatar
            ]),
            $this->mergeWhen($this->email_verified_at, [
                'email_verified_at' => $this->email_verified_at
            ]),
            $this->mergeWhen($this->roles, [
                'role' => $this->roles->pluck('name')->first(),
                'permissions' => $this->roles->pluck('permissions')->first()->map(function ($value) {
                    // Replace ký tự . đầu tiên thành # để sửa lỗi explode cắt lố
                    // Ví dụ: update.users.permissions nếu để nguyên thì nó sẽ cắt thành 3 giá trị
                    // Nên replace lại thành update#user.permissions thì sẽ ra được actions và subject mong muốn
                    [$action, $subject] = \Str::of($value['name'])
                        ->replaceFirst('.', '#')
                        ->explode('#');
                    return [
                        'action' => $action,
                        'subject' => $subject
                    ];
                })
            ]),
        ];
    }
}
