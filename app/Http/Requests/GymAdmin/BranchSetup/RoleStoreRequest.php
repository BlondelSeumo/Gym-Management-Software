<?php

namespace App\Http\Requests\GymAdmin\BranchSetup;

use App\Http\Requests\CoreRequest;

class RoleStoreRequest extends CoreRequest
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
            'role' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'branch_id.required' => 'Select branch.',
            'role.required' => 'Role name is required.',
        ];
    }
}
