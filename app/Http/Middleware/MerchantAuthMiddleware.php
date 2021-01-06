<?php

namespace App\Http\Middleware;

use App\Models\AcePurchase;
use App\Models\Merchant;
use App\Models\MerchantBusiness;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MerchantAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('locked')) {
            return redirect()->route('merchant.lockscreen');
        }

        if (Auth::guard('merchant')->check()) {

            // Update last activity time of merchant
            $merchant = Merchant::find(Auth::guard('merchant')->user()->id);
            $merchant->last_activity = Carbon::now('Asia/Calcutta');
            $merchant->save();

            if (str_contains($request->route()->getName(), 'salon-admin') && Auth::guard('merchant')->user()) {
                return redirect()->route('gym-admin.dashboard.index');
            }

            if (Auth::guard('merchant')->user()) {
                $business = MerchantBusiness::where('merchant_id', '=', Auth::guard('merchant')->user()->id)->first();
                $activePlan = AcePurchase::getBusinessActivePlan($business->detail_id);

                if ($request->route()->getName() != 'gym-admin.buy-plan.index' &&
                    $request->route()->getName() != 'gym-admin.buy-plan.show' &&
                    $request->route()->getName() != 'gym-admin.buy-plan.store' &&
                    $request->route()->getName() != 'gym-admin.logout.index' &&
                    $request->route()->getName() != 'gym-admin.accept-terms' &&
                    Carbon::now('Asia/Calcutta')->diffInDays(Carbon::parse(Auth::guard('merchant')->user()->trial_end_date), false) < 0 &&
                    is_null($activePlan)) {
                    return redirect()->route('gym-admin.buy-plan.index');
                }

                return $next($request);
            }
            else {
                return $next($request);
            }
        }
        else {
            return Redirect::route('merchant.login.index');
        }

    }
}
