<?php

namespace App\Http\Requests\Song;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'other_name' => ['string', 'min:4', 'max:255'],
            'thumbnail' => ['required', 'url', 'unique:songs,thumbnail'],
            'url' => ['required', 'url', 'unique:songs,url'],
            'year' => ['required', 'numeric'],
            'views' => ['numeric'],
            'category' => ['required', 'string', 'exists:categories,name'],
            'artists' => ['required', 'array', 'min:1', 'max:4', 'exists:artists,name'],
        ];
    }
}
