<?php

namespace App\Models;

use App\AcePlans;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AcePurchase extends Model
{
    protected $table = 'ace_purchases';

    protected $dates = ['plan_expires_on', 'plan_starts_on'];

    public function business() {
        return $this->belongsTo(Common::class, 'detail_id');
    }

    public function plan() {
        return $this->belongsTo(AcePlans::class, 'plan_id');
    }

    public static function getByPurchaseId($purchaseId) {
        return AcePurchase::where('purchase_id', $purchaseId)->first();
    }

    public static function getBusinessActivePlan($businessId) {
        return AcePurchase::where('plan_starts_on', '<=', Carbon::today())
            ->where('plan_expires_on', '>=', Carbon::today())
            ->where('plan_status', 'active')
            ->where('status', 'paid')
            ->where('detail_id', $businessId)
            ->orderBy('id', 'desc')
            ->first();
    }

    public static function getInvoiceDetails($businessId, $id) {
        return AcePurchase::where('detail_id', $businessId)
            ->where('status', 'paid')
            ->find($id);
    }

    public static function revenueByMonth($month) {
        return AcePurchase::where(DB::raw('MONTH(created_at)'), $month)
            ->where(DB::raw('YEAR(created_at)'), DB::raw('YEAR(NOW())'))
            ->where('status', 'paid')
            ->sum('grand_total');
    }

    public static function totalRevenue() {
        return AcePurchase::where('status', 'paid')
            ->sum('grand_total');
    }

    public static function currentMonthPurchases() {
        return AcePurchase::where('status', 'paid')
            ->where(DB::raw('MONTH(created_at)'), DB::raw('MONTH(NOW())'))
            ->count();
    }
}
