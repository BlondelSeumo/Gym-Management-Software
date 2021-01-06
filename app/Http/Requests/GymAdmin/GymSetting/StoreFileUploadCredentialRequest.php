<?php

namespace App\Http\Requests\GymAdmin\GymSetting;

use App\Http\Requests\CoreRequest;

class StoreFileUploadCredentialRequest extends CoreRequest
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
        $newRules = [];

        if($this->storage == '0') {
            $newRules = [
                'aws_key' => 'required',
                'aws_secret' => 'required',
                'aws_region' => 'required',
                'aws_bucket' => 'required',
            ];
        }

        return array_merge($rules, $newRules);
    }
}
