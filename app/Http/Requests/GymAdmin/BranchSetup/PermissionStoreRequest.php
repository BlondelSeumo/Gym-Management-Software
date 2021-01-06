<?php

namespace App\Http\Requests\GymAdmin\BranchSetup;

use App\Http\Requests\CoreRequest;

class PermissionStoreRequest extends CoreRequest
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
            'permissions' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'permissions.required' => 'Check at least 1 permission.',
        ];
    }
}
