<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantSmsPurchase extends Model
{
    protected $table = 'merchant_sms_purchase';

    public static function getByPaymentId($id)
    {
        return MerchantSmsPurchase::where('payment_id','=',$id)->first();
    }
}
