<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
{
    public function authorize(Request $request): bool
    {
        /** @var User $user */
        $user = $request->user();

        // Nếu cập nhật chức vụ thì phải kiểm tra xem có quyền chỉnh sửa không
        if ($request->has('role')) {
            if ($user->cannot('update.users.permissions')) return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'name'      =>  ['string', 'min:8', 'max:255'],
            'password'  =>  ['string', 'min:8', 'max:255'],
            'avatar'    =>  ['string', 'url', 'max:255'],
            'role'      =>  ['exists:roles,name']
        ];
    }
}
