<?php

namespace App\Http\Requests\GymAdmin\Tasks;

use App\Http\Requests\CoreRequest;

class StoreUpdateRequest extends CoreRequest
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
            'heading' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'deadline' => 'required',
        ];

        $newRules = [];

        if($this->request->get('reminder') == 1) {
            unset($rules['deadline']);
            $newRules = [
                'deadline' => 'required|date_check',
                'numberOfDays' => 'required',
            ];
        }


        return array_merge($rules, $newRules);
    }
}
