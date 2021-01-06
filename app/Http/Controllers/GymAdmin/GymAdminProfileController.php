<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Http\Requests\GymAdmin\Image\ImageRequest;
use App\Models\Merchant;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class GymAdminProfileController extends GymAdminBaseController
{
    public function index()
    {
        if(!$this->data['user']->can("update_profile"))
        {
            return App::abort(401);
        }

        $this->data['title'] = "Profile";

        return View::make('gym-admin.profile.profile',$this->data);
    }

    public function store() {
        $validator = Validator::make(Input::all(), Merchant::updateRules($this->data['user']->id));

        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }

        $id = Input::get('id');
        $profile = Merchant::find($this->data['user']->id);
        $profile->first_name = Input::get('first_name');
        $profile->last_name = Input::get('last_name');
        $profile->mobile = Input::get('mobile');
        $profile->email = Input::get('email');
        $profile->gender = Input::get('gender');

        if(Input::get('date_of_birth') != '')
            $profile->date_of_birth = Input::get('date_of_birth');

        if(Input::has('password')) {
            $profile->password = Hash::make(Input::get('password'));
        }


        $profile->save();
        return Reply::success('Profile updated');
    }

    public function uploadImage(ImageRequest $request)
    {
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

            if(
                !is_null($this->data['gymSettings']->file_storage) || $this->data['gymSettings']->file_storage != '' ||
                !is_null($this->data['gymSettings']->aws_key) || $this->data['gymSettings']->aws_key != '' ||
                !is_null($this->data['gymSettings']->aws_secret) || $this->data['gymSettings']->aws_secret != '' ||
                !is_null($this->data['gymSettings']->aws_region) || $this->data['gymSettings']->aws_region != '' ||
                !is_null($this->data['gymSettings']->aws_bucket) || $this->data['gymSettings']->aws_bucket != ''
            ) {
                $destinationPathMaster = "/uploads/profile_pic/master/$filename";
                $destinationPathThumb = "/uploads/profile_pic/thumb/$filename";


                $image1 = Image::make($image->getRealPath())
                    ->crop($width, $height, $x, $y)
                    ->resize(206, 207);

                $this->uploadImageS3($image1, $destinationPathMaster);

                $image2 = Image::make($image->getRealPath())
                    ->crop($width, $height, $x, $y)
                    ->resize(40, 40);

                $this->uploadImageS3($image2, $destinationPathThumb);
            } else {
                if (!file_exists(public_path()."/uploads/profile_pic/master/") &&
                    !file_exists(public_path()."/uploads/profile_pic/thumb/")) {
                    File::makeDirectory(public_path()."/uploads/profile_pic/master/", $mode = 0777, true, true);
                    File::makeDirectory(public_path()."/uploads/profile_pic/thumb/", $mode = 0777, true, true);
                }

                $destinationPathMaster = public_path()."/uploads/profile_pic/master/$filename";
                $destinationPathThumb = public_path()."/uploads/profile_pic/thumb/$filename";
                $image1 = Image::make($image->getRealPath())
                    ->resizeCanvas($width, $height, 'center', false, 'rgba(0, 0, 0, 0)');
                $image1->save($destinationPathMaster);

                $image2 = Image::make($image->getRealPath())
                    ->resizeCanvas($width, $height, 'center', false, 'rgba(0, 0, 0, 0)')
                    ->resize(40, 40);
                $image2->save($destinationPathThumb);
            }


            $forUpdate = [
                'image' => $filename
            ];

            $profile = Merchant::find($id);
            $profile->update($forUpdate);

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
}
