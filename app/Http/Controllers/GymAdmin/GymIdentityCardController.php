<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Mail\QRNotification;
use App\Models\GymClient;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class GymIdentityCardController extends GymAdminBaseController
{

    public function index() {
        if(!$this->data['user']->can("generate_i_cards"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Generate I-card';

        return view('gym-admin.i-card.index', $this->data);
    }

    public function clientList($filter) {
        if(!$this->data['user']->can("generate_i_cards"))
        {
            return App::abort(401);
        }

        $clients = GymClient::select('id', 'first_name', 'last_name', 'mobile', 'email', 'image')
            ->where('detail_id', '=', $this->data['user']->detail_id);

        return Datatables::of($clients)
            ->edit_column(
                'id', function ($row) use ($filter) {
                    if ($filter == 'all') {
                        return '<div class="md-checkbox">
                                <input type="checkbox" id="checkbox' . $row->id . '" checked name="userIds[]" value="' . $row->id . '" class="md-check">
                                <label for="checkbox' . $row->id . '">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span></label>
                            </div>';
                    }

                    return '<div class="md-checkbox">
                                <input type="checkbox" id="checkbox' . $row->id . '"  name="userIds[]" value="' . $row->id . '" class="md-check">
                                <label for="checkbox' . $row->id . '">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span></label>
                            </div>';
                }
            )
            ->edit_column(
                'first_name', function ($row) {
                    if ($row->image != '') {
                        return '<img src="' . $this->data['gymSettingPath'] . $row->image . '" style="width:50px;height:50px;" class="img-circle" /> ' . ucwords($row->first_name . ' ' . $row->last_name);
                    }
                    else {
                        return '<img src="'.$this->data['gymSettingPath'].'fitsigma-logo-full.png" style="width:50px;height:50px;" class="img-circle" /> ' . ucwords($row->first_name . ' ' . $row->last_name);

                    }
                }
            )

            ->remove_column('last_name')
            ->remove_column('image')
            ->rawColumns([0,1])
            ->make();
    }

    public function store(Request $request) {
        if(!$this->data['user']->can("generate_i_cards"))
        {
            return App::abort(401);
        }

        $validator = Validator::make($request->all(), ['filter' => 'required']);

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }

        $filter = $request->input('filter');

        if ($filter == 'manual') {
            if (!count($request->input('userIds')) > 0) {
                return Reply::error('Please Select at least one client.');
            }
        }

        $this->data['clients'] = GymClient::whereIn('id', $request->input('userIds'))->get();

        $data = [
            'status' => 'success',
            'content' => view('gym-admin.i-card.create', $this->data)->render()
        ];

        return Reply::successWithData('I-cards generated successfully.', $data);

    }

    public function emailQrCode(Request $request) {

        if(!$this->data['user']->can("generate_i_cards"))
        {
            return App::abort(401);
        }

        $user = GymClient::whereIn('id', $request->input('userIds'))->get();

        foreach($user as $usr){
            $email = $usr->email;
            $name = ucwords($usr->first_name.' '.$usr->last_name);
            $emailSubject = '';

            $this->email['emailText'] = 'Here is your QR code you will need to check in every day at '.ucwords($this->data['common_details']->title);
            $this->email['emailTitle'] = 'Check In QR code - '.ucwords($this->data['common_details']->title);
            $this->email['url'] = null;
            $this->email['email'] = $email;
            $this->email['clientId'] = $usr->id;

            if(is_null($this->data['gymSettings'])){
                $this->email['logo'] = '<img src="'.$this->data['gymSettingPath'].'fitsigma-logo-full.png" height="50" alt="Business Logo" style="border:none">';
            }
            else{
                if($this->data['gymSettings']->image != ''){
                    $this->email['logo'] = '<img src="'.$this->data['gymSettingPath'].$this->data['gymSettings']->image.'" height="50" alt="Business Logo" style="border:none">';
                }
                else{
                    $this->email['logo'] = '<img src="'.$this->data['gymSettingPath'].'fitsigma-logo-full.png" height="150" alt="Business Logo" style="border:none">';
                }
            }

            $this->email['businessName'] = ucwords($this->data['common_details']->title);
            $data = $this->email;

            Mail::to($data['email'])->send(new QRNotification($this->email));

        }

        return Reply::successWithData('I-cards emailed successfully.', ['status' => 'success']);


    }

}
