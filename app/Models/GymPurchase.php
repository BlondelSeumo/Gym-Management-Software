<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymPurchase extends Model
{
    protected $table = "gym_client_purchases";

    protected $guarded = ['id'];

    protected $dates = ['purchase_date', 'next_payment_date', 'start_date', 'expires_on'];

    public function membership() {
        return $this->belongsTo(GymMembership::class, 'membership_id')->withTrashed();
    }

    public function client() {
        return $this->belongsTo(GymClient::class, 'client_id')->withTrashed();
    }

    public static function clientPurchases($id) {
        return GymPurchase::where('client_id', '=', $id)->get();
    }

    public static function clientLatestMembership($id) {
        return GymPurchase::where('client_id', '=', $id)
            ->whereNotNull('membership_id')
            ->orderBy('id', 'desc')
            ->first();
    }

    public static function purchaseByBusiness($businessID) {
        return GymPurchase::where('detail_id', '=', $businessID)->get();
    }
}
