<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantCustomPaymentType extends Model
{
    protected  $table = "merchant_custom_payment_type";
    
    public static function getName($id)
    {
        return MerchantCustomPaymentType::find($id);
    }
}
