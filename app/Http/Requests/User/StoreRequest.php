<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Request $request
     * @return bool
     */
    public function authorize(Request $request)
    {
        $user = $request->user();

        if ($request->has('role')) {
            return $user->can('create.users.role') && $user->tokenCan('create.users.role');
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      =>  ['required', 'string', 'min:8', 'max:255'],
            'email'     =>  ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'  =>  ['required', 'string', 'min:8', 'max:255'],
            'avatar'    =>  ['string', 'url', 'max:255'],
            'role'      =>  ['exists:roles,name']
        ];
    }
}
