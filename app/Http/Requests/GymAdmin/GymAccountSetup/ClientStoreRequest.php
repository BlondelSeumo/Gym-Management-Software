<?php

namespace App\Http\Requests\GymAdmin\GymAccountSetup;


use App\Http\Requests\CoreRequest;

class ClientStoreRequest extends CoreRequest
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
            'marital_status' => 'required',
        ];

        $newRules = [];


        if($this->has('client_id')) {
            $newRules = [
                'email' => 'required|email|unique:gym_clients,email,'.$this->client_id,
                'mobile' => 'required|unique:gym_clients,mobile,'.$this->client_id,
            ];
        } else {
            $newRules = [
                'email' => 'required|email|unique:gym_clients,email,NULL',
                'mobile' => 'required|unique:gym_clients,mobile,NULL',
            ];
        }

        return array_merge($rules, $newRules);

    }
}
