<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GymMembershipPayment extends Model
{
    use SoftDeletes;
    protected $table = 'gym_membership_payments';

    protected $dates = ['payment_date','deleted_at'];

    protected $guarded = ['id'];

    public function client() {
        return $this->belongsTo(GymClient::class, 'user_id')->withTrashed();
    }

    public function purchase() {
        return $this->belongsTo(GymPurchase::class, 'purchase_id');
    }

    public function paymentType() {
        return $this->belongsTo(MerchantCustomPaymentType::class, 'payment_type');
    }

    public function businessBranches() {
        return $this->belongsTo(Common::class, 'detail_id', 'id');
    }

    public static function rules($action) {
        $rules = [
            'custom' => [
                'client' => 'required',
                'payment_amount' => 'required|numeric',
                'payment_source' => 'required',
                'payment_date' => 'required',
            ],
            'membership' => [
                'client' => 'required',
                'payment_amount' => 'required|numeric',
                'payment_source' => 'required',
                'payment_date' => 'required',
                'purchase_id' => 'required',
                'payment_required' => 'required',
            ],
            'ajax_add' => [
                'payment_amount' => 'required|numeric',
                'payment_source' => 'required',
                'payment_date' => 'required'
            ]
        ];
        return $rules[$action];
    }

    public function getCurrentBalance($id) {
        $amount = GymMembershipPayment::leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'purchase_id')
            ->where('gym_membership_payments.detail_id', '=', $id)->sum('payment_amount');

        if(is_null($amount)) {
            return '0';
        }

        return $amount;
    }

    public static function getLastSixMonthBalance($id) {
        $amount = GymMembershipPayment::leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'purchase_id')
            ->where('gym_membership_payments.detail_id', '=', $id)
            ->where('payment_date', '>', Carbon::now()->subMonths(6)->format('Y-m-d'))
            ->sum('payment_amount');

        if(is_null($amount)) {
            return '0';
        }

        return $amount;
    }

    public function getWeeklySales($start,$end,$id) {
        $weeklySales = GymMembershipPayment::where('gym_membership_payments.detail_id', '=', $id)->where('gym_membership_payments.payment_date', '>=', $start)->where('gym_membership_payments.payment_date', '<=', $end)->sum('payment_amount');

        if(is_null($weeklySales)) {
            return '0';
        }

        return $weeklySales;

    }

    public function getMaxSale($id) {
        $amount = GymMembershipPayment::leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'purchase_id')
            ->where('gym_membership_payments.detail_id', '=', $id)->max('gym_membership_payments.payment_amount');

        if(is_null($amount)) {
            return '0';
        }

        return $amount;
    }

    public function getAverageMonthlySales($month,$year,$id) {
        $amount = GymMembershipPayment::leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'purchase_id')
            ->where('gym_membership_payments.detail_id', '=', $id)->whereMonth('gym_membership_payments.payment_date', '=', $month)->whereYear('gym_membership_payments.payment_date', '=', $year)->sum('payment_amount');

        if(is_null($amount)) {
            return '0';
        }

        return $amount;

    }

    public static function paymentByBusiness($businessID) {
        return GymMembershipPayment::leftJoin('gym_client_purchases', 'gym_client_purchases.id', '=', 'gym_membership_payments.purchase_id')
            ->where('gym_client_purchases.detail_id', '=', $businessID)
            ->get();
    }

}
