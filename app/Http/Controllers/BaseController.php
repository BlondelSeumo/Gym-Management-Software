<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\AdminNotification;
use App\Models\Setting;
use App\Traits\SmtpSettingsTrait;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;

class BaseController extends Controller
{
    public $data = [];

    public function sortByOrder($a, $b)
    {
        return $a['time'] - $b['time'];
    }

    public function __construct()
    {
        View::composer(
            ['layouts.frontend.email_system'], function ($view) {
                $setting = Setting::first();
                $view->with('settingDetail', $setting);
            }
        );

        $this->data['cookieDefault'] = ['user_id' => null, 'city_id' => 2, 'location' => null, 'latitude' => '26.90000000', 'longitude' => '75.80000000'];
        /*detect device type*/
        $agent = new Agent();
        $this->data['isPhone'] = $agent->isPhone();
        $this->data['isDesktop'] = $agent->isDesktop();
        $this->data['isAndroid'] = $agent->isAndroidOS();

    }

    public static function getS3Urls($bucket = null)
    {
        return [
            // Salon Image S3 Urls
            'salonHome' => 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/salons/285x179-',
            'salonSearch' => 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/salons/215x164-',
            'salonThumb' => 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/salons/85x85-',
            'salonBig' => 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/salons/1100x730-',
            // Gym Image S3 Urls
            'gymHome' => 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/gyms/285x179-',
            'gymSearch' => 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/gyms/215x164-',
            'gymThumb' => 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/gyms/85x85-',
            'gymBig' => 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/gyms/1100x730-',
            'rateCard' => 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/salon_rate_card/',
            'profilePath' => 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/profile_pic/thumb/',
            'profileHeaderPath' => 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/profile_pic/master/',
            'logo' => 'https://s3.ap-south-1.amazonaws.com/'.$bucket.'/logo/',
        ];
    }

    public function emailNotification($email, $eText, $eTitle, $eHeading, $url = NULL)
    {
        $this->data['email'] = $email;
        $this->data['title'] = $eTitle;
        $this->data['mailHeading'] = $eHeading;
        $this->data['emailText'] = $eText;
        $this->data['url'] = $url;
        $data = $this->data;

        Mail::to($data['email'])->send(new EmailVerification($this->data));

    }


    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    public function getLastQuery()
    {
        $query = DB::getQueryLog();
        return end($query);
    }
}
