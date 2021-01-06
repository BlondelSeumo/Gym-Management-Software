<?php

namespace App\Http\Requests\GymAdmin\GymAccountSetup;


use App\Http\Requests\CoreRequest;

class MembershipStoreRequest extends CoreRequest
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
            'price' => 'required|numeric',
            'duration' => 'required',
        ];

        $newRules = [];

        if($this->has('membership_id')) {
            $newRules = [
                'title' => 'required|unique:gym_memberships,title,'.$this->membership_id.',id,business_category_id,' . $this->business_category_id,
            ];
        } else {
            $newRules = [
                'title' => 'required|unique:gym_memberships,title,NULL,id,business_category_id,' . $this->business_category_id,
            ];
        }

        return array_merge($rules, $newRules);
    }
}
