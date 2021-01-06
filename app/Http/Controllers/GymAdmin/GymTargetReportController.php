<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\GymMembershipPayment;
use App\Models\GymPurchase;
use App\Models\SetTarget;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;

class GymTargetReportController extends GymAdminBaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->data['reportMenu'] = 'active';
        $this->data['targetreportMenu'] = 'active';
    }

    public function index()
    {
        if(!$this->data['user']->can("view_target_report"))
        {
            return App::abort(401);
        }

        $this->data['title'] = "Target Reports";
        $this->data['targets']= SetTarget::where('detail_id','=',$this->data['user']->detail_id)->get();

        return View::make('gym-admin.reports.target.index',$this->data);
    }

    public function store()
    {
        $validator = Validator::make(Input::all(),['target' =>'required']);

        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }

        $target = SetTarget::find(Input::get('target'));
        $information = [];
        if($target->targetType->type == 'subscription') {

            $date = Carbon::createFromFormat('Y-m-d',$target->date);
            $start_date = Carbon::createFromFormat('Y-m-d',$target->start_date);

            $users = GymPurchase::whereBetween('purchase_date',[$start_date->format('Y-m-d'),$date->format('Y-m-d')])
                    ->where('detail_id','=',$this->data['user']->detail_id)->count();
            $report = "Memberships";

            $target_remaining = ($target->value - $users);
            $target_achieve_percent  =  ($users/$target->value)*100;

            $information = [
                'target_achieved'   => $users,
                'target'            => $target->value,
                'target_id'         => $target->id,
                'target_remaining'  => $target_remaining,
                'percent'           => $target_achieve_percent,
                'report'            => $report
            ];

        } else if($target->targetType->type == 'revenue') {

            $date = Carbon::createFromFormat('Y-m-d',$target->date);
            $start_date = Carbon::createFromFormat('Y-m-d',$target->start_date);

            $sales = GymMembershipPayment::leftJoin('gym_client_purchases','gym_client_purchases.id','=','purchase_id')
                    ->whereBetween('payment_date', [$start_date->format('Y-m-d'),$date->format('Y-m-d')])
                    ->where('gym_client_purchases.detail_id','=',$this->data['user']->detail_id)->sum('payment_amount');
            $report = 'Revenue';

            $target_remaining = ($target->value - $sales);
            $target_achieve_percent  =  ($sales/$target->value)*100;

            $information = [
                'target_achieved'   => $sales,
                'target'            => $target->value,
                'target_id'         => $target->id,
                'target_remaining'  => $target_remaining,
                'percent'           => $target_achieve_percent,
                'report'            => $report
            ];
        }

        return Reply::successWithData('Report fetched', ['data' => $information]);
    }

    public function ajax_create($id)
    {
        $target = SetTarget::find($id);
        $date = Carbon::createFromFormat('Y-m-d', $target->date);
        $start_date = Carbon::createFromFormat('Y-m-d', $target->start_date);
        if($target->targetType->type == 'subscription') {

            $users = GymPurchase::select('first_name','last_name','gym_memberships.title','gym_client_purchases.amount_to_be_paid','purchase_date')
                ->leftJoin('gym_memberships','gym_memberships.id','=','membership_id')
                ->leftJoin('gym_clients','gym_clients.id','=','client_id')
                ->whereBetween('purchase_date',[$start_date->format('Y-m-d'),$date->format('Y-m-d')])
                ->where('gym_client_purchases.detail_id','=',$this->data['user']->detail_id);

            return Datatables::of($users)
                ->edit_column('first_name',function($row){
                    return $row->first_name.' '.$row->last_name;
                })
                ->edit_column('purchase_date',function($row){
                    return $row->purchase_date->toFormattedDateString();
                })->remove_column('last_name')->make();
        }

        if($target->targetType->type == 'revenue')
        {

            $sales = GymMembershipPayment::select('first_name','last_name','gym_memberships.title','gym_membership_payments.payment_amount','payment_date')
                        ->leftJoin('gym_client_purchases','gym_client_purchases.id','=','purchase_id')
                        ->leftJoin('gym_clients','gym_clients.id','=','gym_client_purchases.client_id')
                        ->leftJoin('gym_memberships','gym_memberships.id','=','gym_client_purchases.membership_id')
                        ->where('gym_client_purchases.detail_id','=',$this->data['user']->detail_id);
            return Datatables::of($sales)
                ->edit_column('first_name',function($row){
                    return $row->first_name.' '.$row->last_name;
                })
                ->edit_column('payment_date',function($row){
                    return $row->payment_date->toFormattedDateString();
                })->remove_column('last_name')->make();

        }
    }
}
