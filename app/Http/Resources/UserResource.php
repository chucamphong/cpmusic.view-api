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
                // Replace ký tự . đầu tiên thành # để sửa lỗi explode cắt lố
                // Ví dụ: update.users.permissions nếu để nguyên thì nó sẽ cắt thành 3 giá trị
                // Nên replace lại thành update#user.permissions thì sẽ ra được actions và subject mong muốn
                [$actions, $subject] = \Str::of($value['name'])
                    ->replaceFirst('.', '#')
                    ->explode('#');

                return [
                    'actions' => $actions,
                    'subject' => $subject
                ];

            })->all()
        ];
    }
}
