<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\CoreRequest;

class UpdatePasswordRequest extends CoreRequest
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
            'password'=>'required',
            'confirm-password' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'confirm-password.required' => 'The confirm password field is required.',
            'confirm-password.same' => 'The confirm password and password should be same.',
        ];
    }
}
