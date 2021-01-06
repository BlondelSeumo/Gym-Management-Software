<?php

namespace App\Http\Requests\GymAdmin\GymExpense;

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
            'item_name' => 'required',
            'purchase_date' => 'required',
            'price' => 'required|numeric',
            'bill' => 'max:1024|mimes:jpeg,png'
        ];
    }
}
