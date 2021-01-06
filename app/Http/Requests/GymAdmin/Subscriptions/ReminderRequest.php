<?php

namespace App\Http\Requests\GymAdmin\Subscriptions;

use App\Http\Requests\CoreRequest;

class ReminderRequest extends CoreRequest
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
            'payment' => 'required|numeric'
        ];
    }
}
