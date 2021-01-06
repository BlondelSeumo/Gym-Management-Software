<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\MerchantPromotionDatabase;
use App\Models\MerchantPromotionHistory;
use App\Models\MerchantSmsCredit;
use App\Models\MerchantSmsPurchase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;

class GymPromotionController extends GymAdminBaseController
{
    public function __construct() {
        parent::__construct();
        $this->data['promotionMenu'] = 'active';
        $this->data['promotionmainMenu'] = 'active';
    }

    public function index() {
        if (!$this->data['user']->can("view_previous_promotions")) {
            return App::abort(401);
        }

        $this->data['promotionindexMenu'] = 'active';
        $this->data['title'] = "Send Promotions";
        return View::make('gym-admin.promotion.index', $this->data);
    }

    public function create() {
        if (!$this->data['user']->can("send_promotions")) {
            return App::abort(401);
        }

        $this->data['creditsTransactions'] = MerchantSmsPurchase::where('merchant_id', '=', $this->data['user']->id)
            ->where('status', '!=', 'pending')
            ->count();
        $credits = MerchantSmsCredit::where('merchant_id', '=', $this->data['user']->id)->first();

        if (is_null($credits)) {
            $this->data['credits'] = 0;
        }
        else {
            $this->data['credits'] = $credits->credit_balance;
        }

        $this->data['promotionindexMenu'] = '';
        $this->data['promotionsendMenu'] = 'active';
        $this->data['title'] = "Send Promotions";
        return View::make('gym-admin.promotion.create', $this->data);
    }

    public function ajax_create($filter) {
        if (!$this->data['user']->can("view_previous_promotions")) {
            return App::abort(401);
        }

        switch ($filter) {
            Case 'all':
                $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                    ->where('detail_id', '=', $this->data['user']->detail_id);
                break;
            Case 'manual':
                $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                    ->where('detail_id', '=', $this->data['user']->detail_id);
                break;
            Case 'random':
                $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                    ->where('detail_id', '=', $this->data['user']->detail_id);
                break;
            Case 'male':
                $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                    ->where('detail_id', '=', $this->data['user']->detail_id)
                    ->where('gender', '=', 'male')
                    ->get();
                break;
            Case 'female':
                $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                    ->where('detail_id', '=', $this->data['user']->detail_id)
                    ->where('gender', '=', 'female');
                break;
        }

        return Datatables::of($user)
            ->edit_column('id', function ($row) use ($filter) {
                if ($filter != 'random' && $filter != 'manual') {
                    return '<div class="md-checkbox">
                            <input type="checkbox" id="checkbox' . $row->id . '" checked name="userIds[]" value="' . $row->id . '" class="md-check">
                            <label for="checkbox' . $row->id . '">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span></label>
                        </div>';
                }
                return '<div class="md-checkbox">
                            <input type="checkbox" id="checkbox' . $row->id . '" checked  name="userIds[]" value="' . $row->id . '" class="md-check">
                            <label for="checkbox' . $row->id . '">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span></label>
                        </div>';
            })
            ->edit_column('name', function ($row) {
                return ucwords($row->name);
            })
            ->edit_column('email', function ($row) {
                return '<i class="fa fa-envelope"></i> ' . $row->email;
            })
            ->edit_column('mobile', function ($row) {
                return '<i class="fa fa-mobile"></i> ' . $row->mobile;
            })->edit_column('gender', function ($row) {
                if ($row->gender == 'female') {
                    return '<i class="fa fa-female"></i> Female';
                }
                else {
                    return '<i class="fa fa-male"></i> Male';
                }
            })
            ->rawColumns([0,2,3,5])
            ->make();
    }

    public function store() {

        if (!$this->data['user']->can("send_promotions")) {
            return App::abort(401);
        }

        $validator = Validator::make(Input::all(), ['filter' => 'required', 'sms_text' => 'required', 'campaign' => 'required']);

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }

        $message = Input::get('sms_text');
        $campaign = Input::get('campaign');
        if (Input::has('random')) {
            $random = Input::get('random');
        }
        else {
            $random = 0;
        }
        $mobile = array();

        $filter = Input::get('filter');
        if ($filter == 'random') {
            if ($random == '') {
                return Reply::error('Random records field is required');
            }
        }
        if ($filter == 'manual') {
            if (!count(Input::get('userIds')) > 0) {
                return Reply::error('Please Select at least one client.');
            }
        }
        switch ($filter) {
            Case 'all':
                $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                    ->where('detail_id', '=', $this->data['user']->detail_id)
                    ->get();
                break;
            Case 'manual':
                $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                    ->where('detail_id', '=', $this->data['user']->detail_id)
                    ->whereIn('id', Input::get('userIds'))
                    ->get();
                break;
            Case 'random':
                try {
                    $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                        ->where('detail_id', '=', $this->data['user']->detail_id)
                        ->get()->random($random);
                } catch (\Exception $e) {
                    return Reply::error($e->getMessage());
                }
                break;
            Case 'male':
                $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                    ->where('detail_id', '=', $this->data['user']->detail_id)
                    ->where('gender', '=', 'male')
                    ->get();
                break;
            Case 'female':
                $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                    ->where('detail_id', '=', $this->data['user']->detail_id)
                    ->where('gender', '=', 'female')
                    ->get();
                break;
        }

        $MerchantCredits = MerchantSmsCredit::where('merchant_id', '=', $this->data['user']->id)->first();
        if ($MerchantCredits) {
            $credits = $MerchantCredits->credit_balance;
        }
        else {
            return Reply::error('Low credit balance. You need to buy sms credits to send promotion.');
        }
        $creditUsed = count($user);
        if ($creditUsed < $credits) {
            foreach ($user as $u) {
                array_push($mobile, $u->mobile);
            }
            $this->smsNotification($mobile, $message, 1);

            $MerchantCredits->credit_balance = $credits - $creditUsed;
            $MerchantCredits->save();

            $promotion = new MerchantPromotionHistory();
            $promotion->merchant_id = $this->data['user']->id;
            $promotion->campaign_name = $campaign;
            $promotion->sms_text = $message;
            $promotion->credits_used = $creditUsed;
            $promotion->save();

            return Reply::success('Promotions Sent successfully');
        }
        return Reply::error('Not Enough Credit Balance');

    }

    public function ajax_create_promotions() {
        if (!$this->data['user']->can("view_previous_promotions")) {
            return App::abort(401);
        }

        $promotions = MerchantPromotionHistory::select('campaign_name', 'sms_text', 'credits_used')
            ->where('merchant_id', '=', $this->data['user']->id);

        return Datatables::of($promotions)->make();
    }

}
