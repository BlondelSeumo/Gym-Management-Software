<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Http\Requests\GymAdmin\MyBusiness\StoreRequest;
use App\Models\Area;
use App\Models\CommonDetails;
use App\Models\Gym;
use App\Models\Pic;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class MyGymController extends GymAdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['manageMenu'] = 'active';
        $this->data['gymMenu'] = 'active';
    }

    public function index() {
        if (!$this->data['user']->can("my_gym")) {
            return App::abort(401);
        }

        $this->data['title'] = 'My Gym';
        $this->data['areas'] = Area::byCity($this->data['common_details']->city_id);
        $this->data['gym']  = Gym::where('detail_id', '=', $this->data['user']->detail_id)->first();
        $this->data['pics'] = Pic::where('detail_id', '=', $this->data['user']->detail_id)->get();

        return View::make('gym-admin.my-gym.edit', $this->data);
    }

    public function store(StoreRequest $request) {
        if (!$this->data['user']->can("my_gym")) {
            return App::abort(401);
        }

        $type = $request->get('updateType');

        if($type == 'details')
        {
            $details = CommonDetails::find($this->data['user']->detail_id);
            $details->title = $request->get('title');
            $details->area_id    = $request->get('area');
            $details->address = $request->get('address');
            $details->owner_incharge_name = $request->get('owner_incharge_name');
            $details->owner_incharge_name2 = $request->get('owner_incharge_name2');
            $details->email = $request->get('email');
            $details->website = $request->get('website');
            $details->latitude = $request->get('latitude');
            $details->longitude = $request->get('longitude');
            $details->phone = $request->get('phone');
            $details->phone2 = $request->get('phone2');
            $details->last_updated = Carbon::now('Asia/Calcutta')->format('Y-m-d H:i:s');
            $details->save();
        }

        if($type == 'services') {
            $service = Gym::where('detail_id', '=', $this->data['user']->detail_id)->first();
            $service->spa_hot_tub = $request->get('spa_hot_tub');
            $service->sauna_steam_bath = $request->get('sauna_steam_bath');
            $service->massage = $request->get('massage');
            $service->therapies = $request->get('therapies');
            $service->cardio = $request->get('cardio');
            $service->aerobics = $request->get('aerobics');
            $service->yoga = $request->get('yoga');
            $service->air_conditioned = $request->get('air_conditioned');
            $service->towel_service = $request->get('towel_service');
            $service->shower = $request->get('shower');
            $service->lokers = $request->get('lokers');
            $service->juice_bar = $request->get('juice_bar');
            $service->free_trial = $request->get('free_trial');
            $service->free_trial_days = $request->get('free_trial_days');
            $service->dietician_nutrition = $request->get('dietician_nutrition');
            $service->physiotherapist = $request->get('physiotherapist');
            $service->personal_trainer = $request->get('personal_trainer');
            $service->trade_mill = $request->get('trade_mill');
            $service->leg_equipment = $request->get('leg_equipment');
            $service->exercise_bike = $request->get('exercise_bike');
            $service->thigh_equipment = $request->get('thigh_equipment');
            $service->bisceps_trainer = $request->get('bisceps_trainer');
            $service->wrist_forearms = $request->get('wrist_forearms');
            $service->abdomen_abs = $request->get('abdomen_abs');
            $service->back_shoulder = $request->get('back_shoulder');
            $service->type = $request->get('type');
            $service->special_ladies_batch = $request->get('special_ladies_batch');
            $service->gender = $request->get('gender');
            $service->sat_closed = $request->get('sat_closed');
            $service->sun_closed = $request->get('sun_closed');
            $service->gym_monthly_price = $request->get('gym_monthly_price');
            $service->gym_quarterly_price = $request->get('gym_quarterly_price');
            $service->gym_halfyearly_price = $request->get('gym_halfyearly_price');
            $service->gym_yearly_price = $request->get('gym_yearly_price');
            $service->fitness_monthly_price = $request->get('fitness_monthly_price');
            $service->fitness_quarterly_price = $request->get('fitness_quarterly_price');
            $service->fitness_halfyearly_price = $request->get('fitness_halfyearly_price');
            $service->fitness_yearly_price = $request->get('fitness_yearly_price');
            $service->morning_open_time = $request->get('morning_open_time');
            $service->morning_close_time = $request->get('morning_close_time');
            $service->evening_open_time = $request->get('evening_open_time');
            $service->evening_close_time = $request->get('evening_close_time');
            $service->cash = $request->get('cash');
            $service->credit_card = $request->get('credit_card');
            $service->debit_card = $request->get('debit_card');
            $service->save();
        }

        if($type == 'file') {

            $image = $request->file('file');
            $extension = $request->file('file')->getClientOriginalExtension();
            $filename = $request->get("detail_id") . "-" . rand(10000, 99999) . "." . $extension;

            $imageDimensions = [
                [ 'width' =>285, 'height' => 179 ],
                [ 'width' =>215, 'height' => 164 ],
                [ 'width' =>85, 'height' => 85 ],
                [ 'width' =>1100, 'height' => 730 ]
            ];

            foreach ($imageDimensions as $dimension){

                $imageMake = Image::make($image->getRealPath())->resize(650, 650);
                $imageMake->insert(public_path('watermark.png'), 'center');

                $filePath = '/gyms/'.$dimension['width']."x".$dimension['height']."-".$filename;

                if(get_class($imageMake) === 'Intervention\Image\Image') {
                    Storage::put($filePath, $imageMake->stream()->__toString(), 'public');
                } else {
                    Storage::put($filePath, fopen($imageMake, 'r'), 'public');
                }
            }

            $data = [
                "detail_id" => $request->get('detail_id'),
                "image" => $filename
            ];


            Pic::where('detail_id', '=', $data['detail_id'])->update(['main_image' => 'false']);
            $pic = Pic::create($data);

            $mainPic = Pic::find($pic->id);
            $data2['main_image'] = "true";

            $mainPic->update($data2);
        }

        return Reply::success('Your business details are updated successfully.');
        
    }

    public function destroyImage($id,Request $request) {
        if($request->ajax())
        {
            $pic = Pic::find($id);

            Storage::delete('gyms/85x85-'.$pic->image);
            Storage::delete('gyms/215x164-'.$pic->image);
            Storage::delete('gyms/1100x730-'.$pic->image);
            Storage::delete('gyms/285x179-'.$pic->image);
            Pic::destroy($id);

            return Reply::success('Image Removed Successfully');
            
        }
        return Reply::error('Invalid Request');
    }
    
    public function setMain($id,Request $request) {
        if($request->ajax())
        {
            Pic::where('detail_id', '=', $this->data['user']->detail_id)->update(['main_image' => 'false']);
            $mainPic = Pic::find($id);
            $data2['main_image'] = "true";

            $mainPic->update($data2);

            return Reply::success('Image set as Main Image');
        }
        return Reply::error('Invalid Request');
    }

}
