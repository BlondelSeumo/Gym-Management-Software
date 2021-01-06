<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessEnquiry extends Model
{
    protected $table = 'business_enquiries';

    protected $guarded = ['id'];

    protected $dates = ['followup_on'];

    public static function rules($action)
    {
        $rules = [
            'add'=>[
                'username' => 'required',
                'phone' => 'required|numeric',
                'email' => 'email',
                'age'  => 'numeric',
                'postal_code' => 'numeric',
            ], 'edit'=>[
                'username' => 'required',
                'last_name' => 'required',
                'phone' => 'required|numeric',
            ]
        ];
        return $rules[$action];
    }


}
