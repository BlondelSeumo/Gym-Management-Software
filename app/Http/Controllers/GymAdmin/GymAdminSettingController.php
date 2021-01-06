<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Http\Requests\GymAdmin\GymSetting\StoreFileUploadCredentialRequest;
use App\Http\Requests\GymAdmin\GymSetting\StoreMailRequest;
use App\Http\Requests\GymAdmin\GymSetting\StoreOtherSettingRequest;
use App\Models\Currency;
use App\Models\GymSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class GymAdminSettingController extends GymAdminBaseController
{
    public function index()
    {
        if(!$this->data['user']->can("update_settings"))
        {
            return App::abort(401);
        }

        $this->data['merchantSetting'] = GymSetting::GetMerchantInfo($this->data['user']->detail_id);
        $this->data['title'] = "Settings";

        return View::make('gym-admin.setting.general', $this->data);
    }

    public function store()
    {
        $validator  = Validator::make(Input::all(), GymSetting::rules('id'));
        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }
        $setting = GymSetting::firstOrNew(['detail_id' => $this->data['user']->detail_id]);

        if(Input::get('img_name') != '')
        {
            $setting->image = Input::get('img_name');
        }

        $setting->save();

        return Reply::success('Setting updated');
    }

    public function image(Request $request)
    {
        $validator  = Validator::make(Input::all(),GymSetting::rules('image'));
        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }

        if ($request->ajax()) {
            $id = $this->data['user']->id;

            $output = [];
            $image = Input::file('file');

            $x = intval($request->xCoordOne);
            $y = intval($request->yCoordOne);
            $width = intval($request->profileImageWidth);
            $height = intval($request->profileImageHeight);

            $extension = Input::file('file')->getClientOriginalExtension();
            $filename  = $id."-".rand(10000,99999).".".$extension;

            if($this->data['gymSettings']->local_storage == 0) {
                $destinationPathMaster = "/uploads/gym_setting/master/$filename";
                $destinationPathThumb = "/uploads/gym_setting/thumb/$filename";
                $image1 = Image::make($image->getRealPath())
                    ->resizeCanvas($width, $height, 'center', false, 'rgba(0, 0, 0, 0)');

                $this->uploadImageS3($image1, $destinationPathMaster);

                $image2 = Image::make($image->getRealPath())
                    ->resizeCanvas($width, $height, 'center', false, 'rgba(0, 0, 0, 0)')
                    ->resize(40, 40);

                $this->uploadImageS3($image2, $destinationPathThumb);
            } else {
                if (!file_exists(public_path()."/uploads/gym_setting/master/") &&
                    !file_exists(public_path()."/uploads/gym_setting/thumb/")) {
                    File::makeDirectory(public_path()."/uploads/gym_setting/master/", $mode = 0777, true, true);
                    File::makeDirectory(public_path()."/uploads/gym_setting/thumb/", $mode = 0777, true, true);
                }

                $destinationPathMaster = public_path()."/uploads/gym_setting/master/$filename";
                $destinationPathThumb = public_path()."/uploads/gym_setting/thumb/$filename";
                $image1 = Image::make($image->getRealPath())
                    ->resizeCanvas($width, $height, 'center', false, 'rgba(0, 0, 0, 0)');
                $image1->save($destinationPathMaster);

                $image2 = Image::make($image->getRealPath())
                    ->resizeCanvas($width, $height, 'center', false, 'rgba(0, 0, 0, 0)')
                    ->resize(40, 40);
                $image2->save($destinationPathThumb);
            }

            $setting = GymSetting::firstOrNew(['detail_id' => $this->data['user']->detail_id]);
            $setting->image = $filename;
            $setting->save();

            $output['image'] = $filename;
            return json_encode($output);
        }
        else
        {
            return "Illegal request method";
        }

    }

    public function storeFrontImage(Request $request) {
        $validator  = Validator::make(Input::all(), GymSetting::rules('image'));
        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }

        if ($request->ajax()) {
            $id = $this->data['user']->id;

            $output = [];
            $image = Input::file('file');

            $extension = Input::file('file')->getClientOriginalExtension();
            $filename  = $id."-".rand(10000,99999).".".$extension;

            if(
                !is_null($this->data['gymSettings']->aws_key) || $this->data['gymSettings']->aws_key != '' ||
                !is_null($this->data['gymSettings']->aws_secret) || $this->data['gymSettings']->aws_secret != '' ||
                !is_null($this->data['gymSettings']->aws_region) || $this->data['gymSettings']->aws_region != '' ||
                !is_null($this->data['gymSettings']->aws_bucket) || $this->data['gymSettings']->aws_bucket != ''
            ) {
                $destinationPathMaster = "/uploads/gym_setting/master/$filename";
                $destinationPathThumb = "/uploads/gym_setting/thumb/$filename";
                $image1 = Image::make($image->getRealPath());
                $this->uploadImageS3($image1, $destinationPathMaster);

                $image2 = Image::make($image->getRealPath())
                    ->resize(40, 40);

                $this->uploadImageS3($image2, $destinationPathThumb);
            } else {
                if (!file_exists(public_path()."/uploads/gym_setting/master/") &&
                    !file_exists(public_path()."/uploads/gym_setting/thumb/")) {
                    File::makeDirectory(public_path()."/uploads/gym_setting/master/", $mode = 0777, true, true);
                    File::makeDirectory(public_path()."/uploads/gym_setting/thumb/", $mode = 0777, true, true);
                }

                $destinationPathMaster = public_path()."/uploads/gym_setting/master/$filename";
                $destinationPathThumb = public_path()."/uploads/gym_setting/thumb/$filename";
                $image1 = Image::make($image->getRealPath());
                $image1->save($destinationPathMaster);

                $image2 = Image::make($image->getRealPath())
                    ->resize(40, 40);
                $image2->save($destinationPathThumb);
            }

            $setting = GymSetting::firstOrNew(['detail_id' => $this->data['user']->detail_id]);
            $setting->front_image = $filename;
            $setting->save();

            $output['image'] = $filename;
            return json_encode($output);
        }
        else
        {
            return "Illegal request method";
        }
    }

    public function uploadImageS3($imageMake, $filePath) {
        if (get_class($imageMake) === 'Intervention\Image\Image') {
            Storage::put($filePath, $imageMake->stream()->__toString(), 'public');
        } else {
            Storage::put($filePath, fopen($imageMake, 'r'), 'public');
        }
    }

    public function mailPage() {
        $this->data['merchantSetting'] = GymSetting::GetMerchantInfo($this->data['user']->detail_id);

        return view('gym-admin.setting.mail', $this->data);
    }

    public function storeMailCredentials(StoreMailRequest $request) {
        $mailSetting = GymSetting::firstOrNew(['detail_id' => $this->data['user']->detail_id]);
        $mailSetting->mail_driver = $request->get('mail_driver');
        $mailSetting->mail_host = $request->get('mail_host');
        $mailSetting->mail_port = $request->get('mail_port');
        $mailSetting->mail_username = $request->get('mail_username');
        $mailSetting->mail_password = $request->get('mail_password');
        $mailSetting->mail_encryption = $request->get('mail_encryption');
        $mailSetting->mail_name = $request->get('mail_name');
        $mailSetting->mail_email = $request->get('mail_email');
        $mailSetting->save();

        return Reply::success('Setting updated');
    }

    public function fileUploadPage() {
        $this->data['merchantSetting'] = GymSetting::GetMerchantInfo($this->data['user']->detail_id);

        return view('gym-admin.setting.file-upload', $this->data);
    }

    public function storeFileUploadCredentials(StoreFileUploadCredentialRequest $request) {
        $fileUploadSetting = GymSetting::firstOrNew(['detail_id' => $this->data['user']->detail_id]);
        $fileUploadSetting->local_storage = $request->get('storage');
        if($request->get('storage') == 0){
            $fileUploadSetting->file_storage = 's3';
        }
        $fileUploadSetting->aws_key = $request->get('aws_key');
        $fileUploadSetting->aws_secret = $request->get('aws_secret');
        $fileUploadSetting->aws_region = $request->get('aws_region');
        $fileUploadSetting->aws_bucket = $request->get('aws_bucket');
        $fileUploadSetting->save();

        return Reply::success('Setting updated');
    }

    public function othersPage() {
        $this->data['merchantSetting'] = GymSetting::GetMerchantInfo($this->data['user']->detail_id);
        $this->data['currencies'] = Currency::all();

        return view('gym-admin.setting.other', $this->data);
    }

    public function storeOtherSettingCredentials(StoreOtherSettingRequest $request) {
        $otherSetting = GymSetting::firstOrNew(['detail_id' => $this->data['user']->detail_id]);
        $otherSetting->maps_api_key = $request->get('maps_api_key');
        $otherSetting->idle_time = $request->get('idle_time');
        $otherSetting->currency_id = $request->get('currency_id');
        $otherSetting->gstin = $request->get('gstin');
        $otherSetting->save();

        return Reply::success('Setting updated');
    }

    public function footerPage() {
        $this->data['merchantSetting'] = GymSetting::GetMerchantInfo($this->data['user']->detail_id);

        return view('gym-admin.setting.footer', $this->data);
    }

    public function storeFooterSettingCredentials(Request $request) {
        $footerSetting = GymSetting::firstOrNew(['detail_id' => $this->data['user']->detail_id]);
        $footerSetting->about = $request->get('about');
        $footerSetting->fb_url = $request->get('fb_url');
        $footerSetting->twitter_url = $request->get('twitter_url');
        $footerSetting->google_url = $request->get('google_url');
        $footerSetting->youtube_url = $request->get('youtube_url');
        $footerSetting->contact_mail = $request->get('contact_mail');
        $footerSetting->save();

        return Reply::success('Setting updated');
    }

    public function storeCustomerImage(Request $request)
    {
        $validator  = Validator::make(Input::all(), GymSetting::rules('image'));
        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }

        if ($request->ajax()) {
            $id = $this->data['user']->id;

            $output = [];
            $image = Input::file('file');

            $extension = Input::file('file')->getClientOriginalExtension();
            $filename  = $id."-".rand(10000,99999).".".$extension;

            if(
                !is_null($this->data['gymSettings']->aws_key) || $this->data['gymSettings']->aws_key != '' ||
                !is_null($this->data['gymSettings']->aws_secret) || $this->data['gymSettings']->aws_secret != '' ||
                !is_null($this->data['gymSettings']->aws_region) || $this->data['gymSettings']->aws_region != '' ||
                !is_null($this->data['gymSettings']->aws_bucket) || $this->data['gymSettings']->aws_bucket != ''
            ) {
                $destinationPathMaster = "/uploads/gym_setting/master/$filename";
                $destinationPathThumb = "/uploads/gym_setting/thumb/$filename";
                $image1 = Image::make($image->getRealPath());
                $this->uploadImageS3($image1, $destinationPathMaster);

                $image2 = Image::make($image->getRealPath())
                    ->resize(40, 40);

                $this->uploadImageS3($image2, $destinationPathThumb);
            } else {
                if (!file_exists(public_path()."/uploads/gym_setting/master/") &&
                    !file_exists(public_path()."/uploads/gym_setting/thumb/")) {
                    File::makeDirectory(public_path()."/uploads/gym_setting/master/", $mode = 0777, true, true);
                    File::makeDirectory(public_path()."/uploads/gym_setting/thumb/", $mode = 0777, true, true);
                }

                $destinationPathMaster = public_path()."/uploads/gym_setting/master/$filename";
                $destinationPathThumb = public_path()."/uploads/gym_setting/thumb/$filename";
                $image1 = Image::make($image->getRealPath());
                $image1->save($destinationPathMaster);

                $image2 = Image::make($image->getRealPath())
                    ->resize(40, 40);
                $image2->save($destinationPathThumb);
            }

            $setting = GymSetting::firstOrNew(['detail_id' => $this->data['user']->detail_id]);
            $setting->customer_logo = $filename;
            $setting->save();

            $output['image'] = $filename;
            return json_encode($output);
        }
        else
        {
            return "Illegal request method";
        }
    }
}
