<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Traits\MerchantUserTrait;

class Merchant extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, MerchantUserTrait;

    public static $addUserRules = [
        'first_name' => 'required|alpha_spaces',
        'last_name' => 'required|alpha_spaces',
        // 'gender' => 'required',
        'mobile' => 'required|unique:merchants,mobile',
        'password' => 'required|min:6',
        'email' => 'required|email|unique:merchants',
        'username' => 'required|unique:merchants'
    ];

    public static function updateRules($id = null) {
        return [
            'first_name' => 'required|alpha_spaces',
            'last_name' => 'required|alpha_spaces',
            'gender' => 'required',
            'mobile' => 'required|unique:merchants,mobile,' . $id,
//            'password' => 'min:6',
            'email' => 'required|email',
            'username' => 'required|unique:merchants,username,' . $id
        ];
    }

    public static $notification = [
        'notificationMeg' => 'required',
        'merchant'	=>	'required'
    ];

    public function business() {
        return $this->hasMany(MerchantBusiness::class, 'merchant_id', 'id');
    }

    public function common() {
        return $this->belongsTo(Common::class, 'detail_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'business_cat');
    }

    public static function getByBusinessID($detailID) {
        return Merchant::where('detail_id', '=', $detailID)->first();
    }

    public static function merchantDetail($businessId, $id) {
        return Merchant::leftJoin('merchant_businesses', 'merchants.id', '=', 'merchant_businesses.merchant_id')
            ->where('merchant_businesses.detail_id', $businessId)
            ->where('merchants.id', $id)
            ->select('merchants.*')
            ->first();
    }

    public static function lastWeekActive() {
        return Merchant::select('common_details.title', 'merchants.last_activity', 'gym_settings.image', 'merchants.created_at')
            ->where('merchants.last_activity', '>=', Carbon::today('Asia/Calcutta')->subDays(7)->toDateTimeString())
            ->leftJoin('merchant_businesses', 'merchant_businesses.merchant_id', '=', 'merchants.id')
            ->leftJoin('common_details', 'merchant_businesses.detail_id', '=', 'common_details.id')
            ->leftJoin('gym_settings', 'merchant_businesses.detail_id', '=', 'gym_settings.detail_id')
            ->orderBy('merchants.last_activity', 'desc')
            ->get();
    }

    // Users who are not active since last 2 weeks
    public static function notActiveTwoWeeks() {
        return Merchant::select('common_details.title', 'merchants.last_activity')
            ->where('merchants.last_activity', '<', Carbon::today('Asia/Calcutta')->subDays(14)->toDateTimeString())
            ->leftJoin('merchant_businesses', 'merchant_businesses.merchant_id', '=', 'merchants.id')
            ->leftJoin('common_details', 'merchant_businesses.detail_id', '=', 'common_details.id')
            ->orderBy('merchants.last_activity', 'desc')
            ->get();
    }

    public static function trialExpiringInDays($days) {
        return Merchant::select('common_details.title', 'merchants.trial_end_date', 'gym_settings.image')
            ->where('trial_end_date', '>', Carbon::now('Asia/Calcutta'))
            ->where('trial_end_date', '<=', Carbon::today('Asia/Calcutta')->addDays($days)->toDateString())
            ->leftJoin('merchant_businesses', 'merchant_businesses.merchant_id', '=', 'merchants.id')
            ->leftJoin('common_details', 'merchant_businesses.detail_id', '=', 'common_details.id')
            ->leftJoin('gym_settings', 'merchant_businesses.detail_id', '=', 'gym_settings.detail_id')
            ->orderBy('merchants.trial_end_date', 'asc')
            ->get();
    }

    public static function trialExpiredInDays($days) {
        return Merchant::select('common_details.title', 'merchants.trial_end_date', 'gym_settings.image')
            ->where('trial_end_date', '>=', Carbon::today('Asia/Calcutta')->subDays($days)->toDateString())
            ->where('trial_end_date', '<=', Carbon::today('Asia/Calcutta')->toDateString())
            ->leftJoin('merchant_businesses', 'merchant_businesses.merchant_id', '=', 'merchants.id')
            ->leftJoin('common_details', 'merchant_businesses.detail_id', '=', 'common_details.id')
            ->leftJoin('gym_settings', 'merchant_businesses.detail_id', '=', 'gym_settings.detail_id')
            ->orderBy('merchants.trial_end_date', 'desc')
            ->get();
    }

    public static function getByEmail($email) {
        return Merchant::where('email', $email)->first();
    }

    protected $guarded = ['id'];

}
