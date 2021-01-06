<?php

namespace App\Http\Requests\GymAdmin\Targets;

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
        return [
            'target_type' => 'required',
            'title'  => 'required',
            'value'  => 'required|numeric|min:1',
            'date'  => 'required',
            'start_date'  => 'required',
        ];
    }
}
