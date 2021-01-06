<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantBusiness extends Model
{
    protected $table = "merchant_businesses";

    public function business() {
        return $this->belongsTo(Common::class, 'detail_id');
    }

    public function merchant() {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public static function findByMerchant($id) {
        return MerchantBusiness::where('merchant_id','=', $id)
            ->first();
    }

    public static function merchantBusinessDetails($id,$businessID) {
        return MerchantBusiness::where('merchant_id','=', $id)
            ->where('detail_id','=',$businessID)
            ->first();
    }

    protected $fillable = ['merchant_id', 'detail_id'];
}
