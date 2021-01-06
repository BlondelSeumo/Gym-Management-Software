<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Mail\PromotionalMail;
use App\Models\GymEmailCampaign;
use App\Models\GymEmailTemplates;
use App\Models\MerchantPromotionDatabase;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class GymEmailPromotionController extends GymAdminBaseController
{

    public function __construct() {
        parent::__construct();
        $this->data['promotionMenu'] = 'active';
        $this->data['promotionEmailMenu'] = 'active';
    }

    public function index() {
        if (!$this->data['user']->can("view_previous_promotions")) {
            return App::abort(401);
        }

        $this->data['title'] = "Email Campaigns";
        $this->data['emailsTotal'] = GymEmailCampaign::totalSentEmails($this->data['user']->detail_id);
        $this->data['campaignsTotal'] = GymEmailCampaign::totalSentCampaigns($this->data['user']->detail_id);
        return view('gym-admin.email_promotion.index', $this->data);
    }

    public function ajaxCreate() {
        if (!$this->data['user']->can("view_previous_promotions")) {
            return App::abort(401);
        }

        $promotions = GymEmailCampaign::select('campaign_name', 'id', 'email_title', 'no_of_emails', 'status', 'sent_on')
            ->where('detail_id', '=', $this->data['user']->detail_id);

        return Datatables::of($promotions)
            ->add_column(
                'action', function ($row) {

                    if($row->status == 'sent') {
                        return "<a class='btn green btn-xs' href='" . route("gym-admin.email-promotion.edit-campaign", $row->id) . "'><i class=\"fa fa-eye\"></i> View Campaign</a>";
                    }
                    else {
                        return "<a class='btn blue btn-xs' href='" . route("gym-admin.email-promotion.edit-campaign", $row->id) . "'><i class=\"fa fa-edit\"></i> Edit Campaign</a>";
                    }
                }
            )
            ->edit_column(
                'status', function($row){
                    if($row->status == 'draft'){
                        return '<span class="label label-info"> DRAFT </span>';
                    } else {
                        return '<span class="label label-success"> SENT </span>';
                    }
                }
            )
            ->edit_column(
                'sent_on', function($row){
                    if(!is_null($row->sent_on)){
                        return Carbon::createFromFormat('Y-m-d H:i:s', $row->sent_on)->format('d M, y');
                    }
                    else{
                        return 'Not Sent';
                    }
                }
            )
            ->rawColumns([4,6])
            ->make();
    }

    public function create() {
        if (!$this->data['user']->can("send_promotions")) {
            return App::abort(401);
        }

        $this->data['title'] = "Create New Campaign";
        $this->data['emailTemplates'] = GymEmailTemplates::all();
        return view('gym-admin.email_promotion.create', $this->data);
    }

    public function show($id) {
        $template = GymEmailTemplates::find($id);

        if (!is_null($this->data['gymSettings'])) {
            if ($this->data['gymSettings']->image != '') {
                $logo = asset('admin/uploads/gym_admin/logo_img/master/' . $this->data['gymSettings']->image);
            }
            else {
                $logo = false;
            }
        }
        else {
            $logo = false;
        }

        $data = [
            'html' => $template->preview_template,
            'logo' => $logo
        ];
        return Reply::successWithData('Template selected successfully.', $data);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), GymEmailCampaign::$rules);

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }

        if($request->input('campaign_id') != ''){
            $campaign = GymEmailCampaign::find($request->input('campaign_id'));
        }
        else{
            $campaign = new GymEmailCampaign();
        }

        $campaign->campaign_name = $request->input('campaign_name');
        $campaign->template_id = $request->input('template_id');
        $campaign->email_title = $request->input('email_title');
        $campaign->email_content = $request->input('email_content');
        $campaign->detail_id = $this->data['user']->detail_id;
        $campaign->merchant_id = $this->data['user']->id;
        $campaign->save();

        if ($request->input('select_recipient')) {
            return Reply::successWithData('Select the recipients', ['recipient' => true, 'campaignId' => $campaign->id]);
        }

        return Reply::redirect(route('gym-admin.email-promotion.index'), 'Campaign Saved Successfully.');
    }

    public function previewTemplate($id) {
        $this->data['template'] = GymEmailTemplates::find($id);
        return view('gym-admin.email_promotion.preview_template', $this->data);
    }

    public function sendPromotion(Request $request) {
        if (!$this->data['user']->can("send_promotions")) {
            return App::abort(401);
        }

        $validator = Validator::make($request->all(), ['filter' => 'required']);

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }

        $filter = Input::get('filter');

        if ($filter == 'random') {
            $random = Input::get('random');

            if ($random == '') {
                return Reply::error('Random records field is required');
            }
        }
        elseif ($filter == 'manual') {
            if (empty($request->userIds)) {
                return Reply::error('Please Select at least one client.');
            }
        } else {
            if(empty($request->userIds)) {
                return Reply::error('Please Select at least one client.');
            }
        }

        switch ($filter) {
        Case 'all':
                $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                    ->where('detail_id', '=', $this->data['user']->detail_id)
                    ->whereIn('id', Input::get('userIds'))
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
                    ->whereIn('id', Input::get('userIds'))
                    ->get()->random($random);
            } catch (\Exception $e) {
                return Reply::error($e->getMessage());
            }
            break;
        Case 'male':
            $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                ->where('detail_id', '=', $this->data['user']->detail_id)
                ->whereIn('id', Input::get('userIds'))
                ->where('gender', '=', 'male')
                ->get();
            break;
        Case 'female':
                $user = MerchantPromotionDatabase::select('id', 'name', 'email', 'mobile', 'age', 'gender')
                    ->where('detail_id', '=', $this->data['user']->detail_id)
                    ->whereIn('id', Input::get('userIds'))
                    ->where('gender', '=', 'female')
                    ->get();
            break;
        }

        if (!is_null($this->data['gymSettings'])) {
            if ($this->data['gymSettings']->image != '') {
                $emailLogo = asset('admin/uploads/gym_admin/logo_img/master/' . $this->data['gymSettings']->image);
            }
            else {
                $emailLogo = false;
            }
        }
        else {
            $emailLogo = false;
        }

        $campaign = GymEmailCampaign::find($request->input('campaign_id'));

        $message = str_replace('/%%/HEADING/%%/', ucwords($campaign->email_title), $campaign->template->html_template);
        $message = str_replace('/%%/CONTENT/%%/', ucfirst($campaign->email_content), $message);
        $message = str_replace('/%%/COPYRIGHT/%%/', Carbon::today('Asia/Calcutta')->year.'. '.ucwords($this->data['common_details']->title), $message);

        if($emailLogo){
            $message = str_replace('http://ace.huntplex.com/ace/images/ace-logo-black.png', $emailLogo, $message);
        }

        $businessName = ucwords($this->data['common_details']->title);
        $emailSubject = $businessName.' - '.ucfirst($campaign->email_title);
        $this->data['content'] = $message;
        $this->data['emailSubject'] = $emailSubject;

        foreach($user as $usr){
            $email = $usr->email;
            $name = $usr->name;

            Mail::to($email, $name)->send(new PromotionalMail($this->data));
        }

        $campaign->sent_on = Carbon::now('Asia/Calcutta');
        $campaign->status = 'sent';
        $campaign->no_of_emails = count($user);
        $campaign->save();

        return Reply::success('Campaign Sent Successfully.');

    }

    public function viewCampaign($id) {
        if (!$this->data['user']->can("send_promotions")) {
            return App::abort(401);
        }

        $this->data['title'] = "View Campaign";
        $this->data['campaign'] = GymEmailCampaign::sentCampaignDetail($this->data['user']->detail_id, $id);

        if(is_null($this->data['campaign'])){
            abort(401);
        }

        return view('gym-admin.email_promotion.view', $this->data);
    }

    public function editCampaign($id) {
        if (!$this->data['user']->can("send_promotions")) {
            return App::abort(401);
        }

        $this->data['title'] = "Edit Campaign";
        $this->data['emailTemplates'] = GymEmailTemplates::all();
        $this->data['campaignDetail'] = GymEmailCampaign::campaignDetail($this->data['user']->detail_id, $id);

        if(isset($this->data['campaignDetail']->status) && $this->data['campaignDetail']->status == 'sent') {
            return redirect(route('gym-admin.email-promotion.view-campaign', $this->data['campaignDetail']->id));
        }

        return view('gym-admin.email_promotion.edit', $this->data);
    }

}
