<?php

namespace App\Http\Requests\Song;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => ['string', 'min:8', 'max:255'],
            'other_name' => ['string', 'min:8', 'max:255'],
            'thumbnail' => ['url', 'unique:songs,thumbnail'],
            'url' => ['url', 'unique:songs,url'],
            'year' => ['numeric'],
            'views' => ['numeric'],
            'category' => ['string', 'exists:categories,name'],
            'artists' => ['array', 'min:1', 'max:4', 'exists:artists,name'],
        ];
    }
}
