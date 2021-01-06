<?php

namespace App\Http\Requests\CustomerApp\ManageSubscription;

use App\Http\Requests\CoreRequest;

class StoreSubscriptionRequest extends CoreRequest
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
            'branch_id' => 'required',
            'membership_id' => 'required',
            'cost' => 'required',
            'joining_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'branch_id.required' => 'Branch Name is required.',
            'membership_id.required' => 'Membership Name is required.',
            'cost.required' => 'Membership Amount is required.',
            'joining_date.required' => 'Joining Date is required.'
        ];
    }
}
