<?php

namespace App\Http\Requests\GymAdmin\GymAccountSetup;

use App\Http\Requests\CoreRequest;

class ProfileStoreRequest extends CoreRequest
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
            'first_name' => 'required|alpha_spaces',
            'last_name' => 'required|alpha_spaces',
            'gender' => 'required',
            'mobile' => 'required|unique:merchants,mobile,' . $this->id,
            'email' => 'required|email'
        ];
    }
}
