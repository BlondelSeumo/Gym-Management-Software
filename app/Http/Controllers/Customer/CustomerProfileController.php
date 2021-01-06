<?php

namespace App\Http\Controllers\Customer;

use App\Classes\Reply;
use App\Http\Requests\CustomerApp\Profile\StoreProfileRequest;
use App\Models\GymClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CustomerProfileController extends CustomerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer-app.profile.index', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileRequest $request)
    {
        $profileStore = GymClient::find($this->data['customerValues']->id);
        $profileStore->first_name = $request->first_name;
        $profileStore->last_name = $request->last_name;
        $profileStore->mobile = $request->mobile;
        $profileStore->email = $request->email;
        $profileStore->gender = $request->gender;
        $profileStore->marital_status = $request->marital_status;
        $profileStore->height_feet = $request->height_feet;
        $profileStore->height_inches = $request->height_inches;
        $profileStore->weight = $request->weight;
        $profileStore->address = $request->address;

        if($profileStore->dob) {
            $profileStore->dob = Carbon::createFromFormat('m/d/Y', $request->dob)->format('Y-m-d');
        }

        if($request->anniversary) {
            $profileStore->anniversary = Carbon::createFromFormat('m/d/Y', $request->anniversary)->format('Y-m-d');
        }

        if($request->password) {
            $profileStore->password = Hash::make($request->password);
        }
        $profileStore->save();

        return Reply::success('Profile Updated successfully');
    }

    public function uploadImage(Request $request)
    {
        if ($request->ajax()) {
            $id = $this->data['customerValues']->id;
            $output = [];
            $image = Input::file('file');

            $x = intval($request->xCoordOne);
            $y = intval($request->yCoordOne);
            $width = intval($request->profileImageWidth);
            $height = intval($request->profileImageHeight);

            $extension = Input::file('file')->getClientOriginalExtension();
            $filename  = $id."-".rand(10000,99999).".".$extension;

            if($this->data['gymSettings']->local_storage == 0) {
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

            $profile = GymClient::find($id);
            $profile->update($forUpdate);

            $output['image'] = $filename;
            return json_encode($output);
        }
        else
        {
            return "Illegal request method";
        }

    }

    public function uploadImageS3($imageMake, $filePath)
    {
        if (get_class($imageMake) === 'Intervention\Image\Image') {
            Storage::put($filePath, $imageMake->stream()->__toString(), 'public');
        } else {
            Storage::put($filePath, fopen($imageMake, 'r'), 'public');
        }
    }

    public function uploadWebcamImage($id)
    {
        $image = Input::file('webcam');

        $fileName = $id . "-" . rand(10000, 99999) . ".jpg";
        if($this->data['gymSettings']->local_storage == 0) {
            $destinationPathMaster = "profile_pic/master/$fileName";
            $destinationPathThumb = "profile_pic/thumb/$fileName";

            $image1 = Image::make($image->getRealPath())
                ->resize(206, 155);

            $this->uploadImageS3($image1, $destinationPathMaster);

            $image2 = Image::make($image->getRealPath())
                ->resize(35, 34);

            $this->uploadImageS3($image2, $destinationPathThumb);
        } else {
            if (!file_exists(public_path()."/uploads/profile_pic/master/") &&
                !file_exists(public_path()."/uploads/profile_pic/thumb/")) {
                File::makeDirectory(public_path()."/uploads/profile_pic/master/", $mode = 0777, true, true);
                File::makeDirectory(public_path()."/uploads/profile_pic/thumb/", $mode = 0777, true, true);
            }

            $destinationPathMaster = public_path()."/uploads/profile_pic/master/$fileName";
            $destinationPathThumb = public_path()."/uploads/profile_pic/thumb/$fileName";
            $image1 = Image::make($image->getRealPath())
                ->resize(206, 155);
            $image1->save($destinationPathMaster);

            $image2 = Image::make($image->getRealPath())
                ->resize(35, 34);
            $image2->save($destinationPathThumb);
        }


        $gym_client = GymClient::find($id);
        $gym_client->image = $fileName;
        $gym_client->save();

        $output['image'] = $fileName;

        return $output;
    }
}
