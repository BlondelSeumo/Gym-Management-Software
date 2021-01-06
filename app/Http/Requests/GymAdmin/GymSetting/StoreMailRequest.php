<?php

namespace App\Http\Requests\GymAdmin\GymSetting;

use App\Http\Requests\CoreRequest;

class StoreMailRequest extends CoreRequest
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
            'mail_driver' => 'required',
            'mail_name' => 'required',
            'mail_email' => 'required',
        ];

        $newRules = [];

        if($this->mail_driver == 'smtp') {
            $newRules = [
                'mail_host' => 'required',
                'mail_port' => 'required|numeric',
                'mail_username' => 'required',
                'mail_password' => 'required',
                'mail_encryption' => 'required',
            ];
        }

        return array_merge($rules, $newRules);
    }
}
