<?php

namespace App\Http\Requests\GymAdmin\GymAccountSetup;

use App\Http\Requests\CoreRequest;

class SubscriptionStoreRequest extends CoreRequest
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
            'user_id' => 'required',
            'purchase_amount' => 'required',
            'amount_to_be_paid' => 'required',
            'purchase_date' => 'required',
            'start_date' => 'required',
            'membership_id' => 'required_if:payment_for,==,membership',
        ];
    }
}
