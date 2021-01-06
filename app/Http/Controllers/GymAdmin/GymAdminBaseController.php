<?php

namespace App\Http\Controllers\GymAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Mail\Notification;
use App\Models\AcePurchase;
use App\Models\BusinessBranch;
use App\Models\Common;
use App\Models\GymClient;
use App\Models\GymMembership;
use App\Models\GymMembershipPayment;
use App\Models\GymPurchase;
use App\Models\GymSetting;
use App\Models\MerchantBusiness;
use App\Models\MerchantNotification;
use App\Models\MerchantPromotionDatabase;
use App\Models\SoftwareUpdate;
use App\Traits\FileSystemSettingTrait;
use App\Traits\SmtpSettingsTrait;
use Illuminate\Support\Facades\Config;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class GymAdminBaseController extends Controller
{
    use SmtpSettingsTrait, FileSystemSettingTrait;
    public $data = [];
    public $email = [];

    public function __construct() {
        $this->data['user'] = null;

        $this->middleware(function ($request, $next) {
            if(\Auth::guard('merchant')->check()) {
                $this->data['user'] = \Auth::guard('merchant')->user();
            }

            if (Session::has('business_id')) {
                $businessID = Session::get('business_id');
                $this->data['user']->detail_id = $businessID;
                $this->data['businessBranch'] = BusinessBranch::businessBranches($businessID);
                $this->data['merchantBusiness'] = MerchantBusiness::merchantBusinessDetails($this->data['user']->id, $businessID);
            }
            else{
                // Assign default business
                if($this->data['user']){
                    $business = MerchantBusiness::where('merchant_id','=', $this->data['user']->id)->first();
                    $this->data['user']->detail_id = $business->detail_id;
                    $this->data['businessBranch'] = BusinessBranch::businessBranches($business->detail_id);
                    $this->data['merchantBusiness'] = MerchantBusiness::findByMerchant($this->data['user']->id);
                }
            }

            $this->data['common_details'] = Common::where('id', '=', $this->data['user']->detail_id)->first();

            $this->data['gymSettings'] = GymSetting::GetMerchantInfo($this->data['user']->detail_id);

            //Mail credentials append to env
            $this->setMailConfigs();
            // File storage credentials append to env
            $this->setFileSystemConfigs();

            $this->data['gymSwUpdates'] = SoftwareUpdate::orderBy('id', 'desc')->first();

            // Check active plan
            $this->data['activePlan'] = AcePurchase::getBusinessActivePlan($this->data['user']->detail_id);

            /*get notifications*/
            $this->data['notifications'] = MerchantNotification::where('detail_id', '=', $this->data['user']->detail_id)
                ->orderBy('id', 'desc')
                ->get();

            $this->data['unreadNotifications'] = MerchantNotification::where('detail_id', '=', $this->data['user']->detail_id)
                ->where('read_status', '=', 'unread')
                ->count();

            /*account setup progress*/
            $this->data['completedItemsRequired'] = 6;
            $this->data['completedItems'] = 0;

            if(trim($this->data['user']->username) != "")
            {
                $this->data['completedItems'] = $this->data['completedItems'] + 1;
            }

            if(trim($this->data['user']->first_name) != "" && trim($this->data['user']->last_name) != "" && trim($this->data['user']->mobile) != "")
            {
                $this->data['completedItems'] = $this->data['completedItems'] + 1;
            }


            $this->data['memberships'] = GymMembership::membershipByBusiness($this->data['user']->detail_id);

            if(count($this->data['memberships']) > 0)
            {
                $this->data['completedItems'] = $this->data['completedItems'] + 1;
            }

            $this->data['clients'] = GymClient::GetClients($this->data['user']->detail_id);

            if(count($this->data['clients']) > 0)
            {
                $this->data['completedItems'] = $this->data['completedItems'] + 1;
            }

            $this->data['subscriptions'] = GymPurchase::purchaseByBusiness($this->data['user']->detail_id);

            if(count($this->data['subscriptions']) > 0)
            {
                $this->data['completedItems'] = $this->data['completedItems'] + 1;
            }

            $this->data['payments'] = GymMembershipPayment::paymentByBusiness($this->data['user']->detail_id);

            if(count($this->data['payments']) > 0)
            {
                $this->data['completedItems'] = $this->data['completedItems'] + 1;
            }

            $this->data['branches'] = BusinessBranch::select('common_details.id', 'common_details.title', 'business_branches.owner_incharge_name')
                ->leftJoin('common_details', 'common_details.id', '=','business_branches.detail_id')
                ->get();

            return $next($request);
        });

        // Default title
        $this->data['title'] = "Dashboard";

        /*detect device type*/
        $agent = new Agent();
        $this->data['isPhone'] = $agent->isPhone();
        $this->data['isDesktop'] = $agent->isDesktop();
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

    }

    public function smsNotification($numbers, $message, $Route = 4) {
        // Your authentication key
        $authKey = env('MSG91_API_KEY');

        // Multiple mobiles numbers separated by comma
        $mobileNumber = implode(',', $numbers);

        // Sender ID,While using route4 sender id should be 6 characters long.
        // $senderId = "555000"; //for promotional
        $senderId = "HPXACE";   //for transactional

        // Your message to send, Add URL encoding here.
        $message = urlencode($message);

        // Define route
        // $route = "1"; //for promotional
        $route = $Route; //for transactional

        // Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );

        // API URL
        $url = "https://control.msg91.com/sendhttp.php";

        // init the resource
        $ch = curl_init();
        curl_setopt_array(
            $ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            // CURLOPT_FOLLOWLOCATION => true
            )
        );


        // Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        // Get response
        $output = curl_exec($ch);

        // Print error if any
        if(curl_errno($ch))
        {
            return 'error:' . curl_error($ch);
        }

        curl_close($ch);

        return $output;
    }

    public function emailNotification($email, $eText, $eTitle, $eHeading, $url = null) {
        $this->email['emailText'] = $eText;
        $this->email['emailTitle'] = $eTitle;
        $this->email['url'] = $url;
        $this->email['email'] = $email;

        if(is_null($this->data['gymSettings'])){
            $this->email['logo'] = '<img src="'.$this->data['gymSettingPath'].'fitsigma-logo-full.png'.'" height="50" alt="Business Logo" style="border:none">';
        }
        else{
            if($this->data['gymSettings']->image != ''){
                $this->email['logo'] = '<img src="'.$this->data['gymSettingPath'].$this->data['gymSettings']->image.'" height="50" alt="Business Logo" style="border:none">';
            }
            else{
                $this->email['logo'] = '<img src="'.$this->data['gymSettingPath'].'fitsigma-logo-full.png'.'" height="50" alt="Business Logo" style="border:none">';
            }
        }

        $this->email['businessName'] = ucwords($this->data['common_details']->title);
        $data = $this->email;

        Mail::to($data['email'])->send(new Notification($data));

    }

    public function emailNotificationAttachment($email, $eText, $eTitle, $eHeading, $url = null, $attachment) {
        $this->email['email'] = $email;
        $this->email['emailTitle'] = $eTitle;
        $this->email['emailText'] = $eText;
        $this->email['url'] = null;
        $this->email['attachment'] = $attachment;

        if(is_null($this->data['gymSettings'])){
            $this->email['logo'] = '<img src="'.$this->data['gymSettingPath'].'fitsigma-logo-full.png'.'" height="50" alt="Business Logo" style="border:none">';
        }
        else{
            if($this->data['gymSettings']->image != ''){
                $this->email['logo'] = '<img src="'.$this->data['gymSettingPath'].$this->data['gymSettings']->image.'" height="50" alt="Business Logo" style="border:none">';
            }
            else{
                $this->email['logo'] = '<img src="'.$this->data['gymSettingPath'].'fitsigma-logo-full.png'.'" height="50" alt="Business Logo" style="border:none">';
            }
        }

        $this->email['businessName'] = ucwords($this->data['common_details']->title);
        $data = $this->email;

        Mail::to($data['email'])->send(new EmailVerification($data));

    }

    public function addPromotionDatabase($data) {
        if($data['number'][0] === "0")
        {
            $number = substr($data['number'], 1);
        }
        elseif(substr($data['number'], 0, 3) == "+91")
        {
            $number = substr($data['number'], 3);
        }
        else{
            $number = $data['number'];
        }

        $user = MerchantPromotionDatabase::where('mobile', '=', $number)->where('detail_id', '=', $this->data['user']->detail_id)->first();

        if(!is_null($user))
        {
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->age = $data['age'];
            $user->gender = $data['gender'];
            $user->save();
        }
        else{
            $user = new MerchantPromotionDatabase();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->age = $data['age'];
            $user->gender = $data['gender'];
            $user->mobile = $number;
            $user->detail_id = $this->data['user']->detail_id;
            $user->save();
        }
    }

}
