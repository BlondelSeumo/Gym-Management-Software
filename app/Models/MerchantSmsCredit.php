<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantSmsCredit extends Model
{
    protected $table = 'merchant_sms_credits';


    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];


    public static function rules($action)
    {
        $rules = [
            'add'=>[
                'credit_balance' => 'required|numeric',

            ]
        ];
        return $rules[$action];
    }

}
