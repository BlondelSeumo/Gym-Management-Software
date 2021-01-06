<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\CoreRequest;

class RegisterStoreRequest extends CoreRequest
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
            'branch_id' => 'required',
            'first_name' => 'required|alpha_spaces',
            'last_name' => 'required|alpha_spaces',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'branch_id.required' => 'Branch Name is required.',
            'confirm_password.required' => 'The confirm password field is required.',
            'confirm_password.same' => 'The confirm password and password should be same.',
        ];
    }
}
