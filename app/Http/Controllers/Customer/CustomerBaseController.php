<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\BusinessCustomer;
use App\Models\GymClient;
use App\Models\GymSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class CustomerBaseController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->data['customerCheck'] = null;
        $this->data['customerValues'] = null;

        $this->middleware(function($request, $next) {
            if(Auth::guard('customer')->check()) {
                $this->data['customerCheck'] = Auth::guard('customer')->check();
                $this->data['customerValues'] = Auth::guard('customer')->user();
            }

            // Assign default business
            if($this->data['customerValues']) {
                $business = BusinessCustomer::where('customer_id','=', $this->data['customerValues']->id)
                    ->first();
                $this->data['customerValues']->detail_id = $business->detail_id;
                $this->data['customerBusiness'] = BusinessCustomer::findByCustomer($this->data['customerValues']->id);
                $customer = GymClient::find($this->data['customerValues']->id);

                $this->data['notifications'] = [];
                foreach ($customer->notifications as $notification) {
                    if($notification->data['customer_id'] == $this->data['customerValues']->id) {
                        array_push($this->data['notifications'], $notification->data);
                    }
                }

                $count = 0;
                foreach ($customer->unreadNotifications as $notification) {
                    if($notification->data['customer_id'] == $this->data['customerValues']->id) {
                        $count++;
                    }
                }
                $this->data['unreadNotifications'] = $count;
            }

            return $next($request);
        });

        $agent = new Agent();
        $this->data['isPhone'] = $agent->isPhone();
        $this->data['isDesktop'] = $agent->isDesktop();
        $this->data['gymSettings'] = GymSetting::first();

        $bucket = '';
        if(isset($this->data['gymSettings']) && !is_null($this->data['gymSettings']->aws_bucket)) {
            $bucket = $this->data['gymSettings']->aws_bucket;
        }
        $s3Urls = BaseController::getS3Urls($bucket);
        $this->data['salonHome'] = $s3Urls['salonHome'];
        $this->data['salonSearch'] = $s3Urls['salonSearch'];
        $this->data['salonThumb'] = $s3Urls['salonThumb'];
        $this->data['salonBig'] = $s3Urls['salonBig'];
        // Gym Image S3 Urls
        $this->data['gymHome'] = $s3Urls['gymHome'];
        $this->data['gymSearch'] = $s3Urls['gymSearch'];
        $this->data['gymThumb'] = $s3Urls['gymThumb'];
        $this->data['gymBig'] = $s3Urls['gymBig'];

        $this->data['rateCard'] = $s3Urls['rateCard'];

        $this->data['profilePath'] = $s3Urls['profilePath'];
        $this->data['profileHeaderPath'] = $s3Urls['profileHeaderPath'];
        $this->data['gymSettingPathThumb'] = 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/gym_setting/thumb/';
        $this->data['gymSettingPath'] = 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/gym_setting/master/';
        $this->data['gymOffersPath'] = 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/gyms_offers/';
        $this->data['expenseUrl'] = 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/bill/';
        $this->data['logo'] = $s3Urls['logo'];

        Config::set('auth.model', 'Customer');
    }

    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = view($this->layout);
        }
    }

    public function getLastQuery()
    {
        $query = DB::getQueryLog();
        return end($query);
    }
}
