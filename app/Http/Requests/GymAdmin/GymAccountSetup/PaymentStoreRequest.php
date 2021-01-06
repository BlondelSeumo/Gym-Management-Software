<?php

namespace App\Http\Requests\GymAdmin\GymAccountSetup;

use App\Http\Requests\CoreRequest;

class PaymentStoreRequest extends CoreRequest
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
            'client' => 'required',
            'payment_amount' => 'required|numeric',
            'payment_source' => 'required',
            'payment_date' => 'required',
        ];

        $membershipRules = [];

        if($this->request->get('payment_type') == 'membership') {
            $membershipRules = [
                'purchase_id' => 'required',
                'payment_required' => 'required'
            ];
        }

        return array_merge($rules, $membershipRules);
    }
}
