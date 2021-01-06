<?php

namespace App\Http\Requests\GymAdmin\BranchSetup;

use App\Http\Requests\CoreRequest;

class BranchStoreRequest extends CoreRequest
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
            'title' => 'required',
            'owner_incharge_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Branch name is required.',
            'owner_incharge_name.required' => 'Incharge name is required.',
            'address.required' => 'Address is required.',
            'phone.required' => 'Mobile is required.',
            'email.required' => 'Email is required.',
        ];
    }
}
