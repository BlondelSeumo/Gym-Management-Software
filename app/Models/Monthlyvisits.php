<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Monthlyvisits extends Model
{

    protected $table = "business_monthly_visits";

    public function common() {
        return $this->belongsTo(Common::class, 'detail_id');
    }

    public static function getCurrentMonthViews($detailId) {
        $now = Carbon::now('Asia/Calcutta');
        return Monthlyvisits::where('detail_id', '=', $detailId)
            ->whereRaw('MONTH(`created_at`) = ?', [$now->month])
            ->whereRaw('YEAR(`created_at`) = ?', [$now->year])
            ->first();
    }

    public static function getMonthViews($detailId, $month) {
        return Monthlyvisits::where('detail_id', '=', $detailId)
            ->whereRaw('MONTH(`created_at`) = ?', [$month])
            ->whereRaw('YEAR(`created_at`) = ?', ['2017'])
            ->first();
    }

    public static function getTotalViews() {
        $previousViews = Common::sum('views');
        return Monthlyvisits::sum('views') + $previousViews;
    }

    public static function getTotalBusinessViews($detailID) {
        $previousViews = Common::where('id', '=', $detailID)->sum('views');
        return Monthlyvisits::where('detail_id', '=', $detailID)->sum('views') + $previousViews;
    }

    public static function getTotalMonthViews($month) {
        $now = Carbon::now('Asia/Calcutta');
        return Monthlyvisits::whereRaw('MONTH(`created_at`) = ?', [$month])
            ->whereRaw('YEAR(`created_at`) = ?', [$now->year])
            ->sum('views');
    }

    public static function getPopularBusinesses($gymsForShow, $categoryId, $businessId) {
        $now = Carbon::now('Asia/Calcutta');
        return Monthlyvisits::leftJoin('common_detail', 'common_detail.id', '=', 'business_monthly_visits.detail_id')
            ->leftJoin('areas', 'common_detail.area_id', '=', 'areas.id')
            ->leftJoin('city', 'common_detail.city_id', '=', 'city.id')
            ->leftJoin('pics', 'pics.detail_id', '=', 'common_detail.id')
            ->select('common_detail.title', 'common_detail.slug', 'areas.name', 'business_monthly_visits.views', 'pics.image', 'areas.slug as aslug', 'city.slug as cslug', 'common_detail.avg_rating')
            ->where('common_detail.category_id', '=', $categoryId)
            ->where('common_detail.id', '<>', $businessId)
            ->whereIn('common_detail.id', $gymsForShow)
            ->where('pics.main_image', '=', 'true')
            ->groupBy('common_detail.id')
            ->whereRaw('MONTH(business_monthly_visits.`created_at`) = ?', [$now->month])
            //->whereRaw('business_monthly_visits.`created_at` >=?', [Carbon::now()->subMonth()])
            ->orderBy('business_monthly_visits.views', 'desc')
            ->take(5)->skip(0)
            ->get();
    }

    public static function getPopularBusinessesIds($areaId, $categoryId, $businessId) {
        $now = Carbon::now('Asia/Calcutta');
        return Monthlyvisits::leftJoin('common_detail', 'common_detail.id', '=', 'business_monthly_visits.detail_id')
            ->select('common_detail.id', 'common_detail.latitude', 'common_detail.longitude')
            ->where('common_detail.category_id', '=', $categoryId)
            ->where('common_detail.id', '<>', $businessId)
            ->where('common_detail.status', '=', 'active')
            ->whereRaw('MONTH(business_monthly_visits.`created_at`) = ?', [$now->month])
            //->whereRaw('business_monthly_visits.`created_at` >=?', [Carbon::now()->subMonth()])
            ->get();
    }

    public function getDatesAttribute($value) {
        $this->attributes['created_at'] = Carbon::createFromFormat('m/d/Y', $value);
    }

    protected $guarded = ['id'];
}