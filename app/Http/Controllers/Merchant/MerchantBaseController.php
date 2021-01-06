<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class MerchantBaseController extends BaseController
{

    public $data = [];

    public function __construct()
    {
        $this->data['userCheck'] = null;
        $this->data['userValue'] = null;

        $this->middleware(function ($request, $next) {
            if(Auth::guard('merchant')->check()) {
                $this->data['userCheck'] = Auth::guard('merchant')->check();
                $this->data['userValue'] = Auth::guard('merchant')->user();
            }

            return $next($request);
        });

        $this->data['title'] = "Dashboard";
        $s3Urls = BaseController::getS3Urls();
        // Salom Image S3 Urls
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
        $this->data['gymSettingPathThumb'] = 'https://s3.ap-south-1.amazonaws.com/'.env('AWS_BUCKET').'/gym_setting/thumb/';
        $this->data['gymSettingPath'] = 'https://s3.ap-south-1.amazonaws.com/'.env('AWS_BUCKET').'/gym_setting/master/';
        $this->data['gymOffersPath'] = 'https://s3.ap-south-1.amazonaws.com/'.env('AWS_BUCKET').'/gyms_offers/';
        $this->data['expenseUrl'] = 'https://s3.ap-south-1.amazonaws.com/'.env('AWS_BUCKET').'/bill/';
        #set authorisation model for Admin login
        Config::set('auth.model', 'Merchant');
    }

    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
    }

    public function getLastQuery()
    {
        $query = DB::getQueryLog();
        return end($query);
    }
}
