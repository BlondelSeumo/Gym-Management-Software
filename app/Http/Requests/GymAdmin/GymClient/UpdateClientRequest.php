<?php

namespace App\Http\Requests\GymAdmin\GymClient;

use App\Http\Requests\CoreRequest;

class UpdateClientRequest extends CoreRequest
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
        $rules = [];
        if($this->request->get('type') == 'general') {
            $rules = [
                'first_name' => 'required|alpha_spaces',
                'last_name' => 'required|alpha_spaces',
                'gender' => 'required',
                'email' => 'required|email|unique:gym_clients,email,'.$this->request->get('id'),
                'mobile' => 'required|unique:gym_clients,mobile,'.$this->request->get('id'),
                'marital_status' => 'required',
            ];
        } else {
            $rules = [
                'file' => ''
            ];
        }

        return $rules;
    }
}
