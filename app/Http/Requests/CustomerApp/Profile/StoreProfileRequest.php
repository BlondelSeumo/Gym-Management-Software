<?php

namespace App\Http\Requests\CustomerApp\Profile;

use App\Http\Requests\CoreRequest;

class StoreProfileRequest extends CoreRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'gender' => 'required'
        ];
    }
}
