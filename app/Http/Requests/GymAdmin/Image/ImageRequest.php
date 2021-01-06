<?php

namespace App\Http\Requests\GymAdmin\Image;

use App\Http\Requests\CoreRequest;

class ImageRequest extends CoreRequest
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
            'file' => 'mimes:jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'file.mimes' => 'Image should be jpeg,jpg and png format.'
        ];
    }
}
