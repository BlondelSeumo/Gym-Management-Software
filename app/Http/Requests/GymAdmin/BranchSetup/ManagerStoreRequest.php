<?php

namespace App\Http\Requests\GymAdmin\BranchSetup;

use App\Http\Requests\CoreRequest;

class ManagerStoreRequest extends CoreRequest
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
        $rules = [
            'first_name' => 'required|alpha_spaces',
            'last_name' => 'required|alpha_spaces',
            'gender' => 'required',
            'mobile' => 'required|unique:merchants,mobile,' . $this->manager_id,
            'email' => 'required|email',
        ];

        $newRules = [];

        if(!$this->has('manager_id')) {
            $newRules = [
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ];
        }
        return array_merge($rules, $newRules);
    }
}
