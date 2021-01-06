<?php

namespace App\Http\Controllers\GymAdmin;


use App\Classes\Reply;
use App\Models\GymMembershipPayment;
use App\Models\GymPurchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;

class GymFinanceReportController extends GymAdminBaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->data['reportMenu'] = 'active';
        $this->data['financialreportMenu'] = 'active';
    }

    public  function index()
    {
        if(!$this->data['user']->can("view_finance_report"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Finance Report';
        return View::make('gym-admin.reports.finance.index',$this->data);
    }

    public function store()
    {
        $validator  = Validator::make(Input::all(),['type'=>'required','date_range'=>'required']);

        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }else{
            $choice = Input::get('type');
            $date_range = explode('-',Input::get('date_range'));

            $date_range_start = Carbon::createFromFormat('M d, Y',trim($date_range[0]));
            $date_range_end   = Carbon::createFromFormat('M d, Y',trim($date_range[1]));
            $payment =0;
            if($choice == 'all')
            {
                $payment = GymMembershipPayment::select(
                    'gym_membership_payments.payment_amount')
                    ->leftJoin('gym_client_purchases',function ($join){
                        $join->on('gym_membership_payments.purchase_id','=','gym_client_purchases.id')
                            ->whereNotNull('gym_membership_payments.purchase_id');
                    })
                    ->whereBetween('payment_date',[$date_range_start->format('Y-m-d'),$date_range_end->format('Y-m-d')])
                    ->where('gym_membership_payments.detail_id','=',$this->data['user']->detail_id)
                    ->sum('payment_amount');
            }

            $data = [
                'total'             => $payment,
                'start_date'        => $date_range_start->format('Y-m-d'),
                'end_date'          => $date_range_end->format('Y-m-d'),
                'type'              => $choice,
                'report'            => 'Finance'
            ];
            return Reply::successWithData('Reports Fetched',$data);
        }
    }

    public function ajax_create($type,$start_date,$end_date)
    {
        if($type == 'all'){
            $payment = GymMembershipPayment::select(
                'first_name',
                'last_name',
                'gym_membership_payments.payment_amount',
                'gym_membership_payments.payment_source',
                'gym_membership_payments.payment_date')
                ->leftJoin('gym_client_purchases',function ($join){
                    $join->on('gym_membership_payments.purchase_id','=','gym_client_purchases.id')
                        ->whereNotNull('gym_membership_payments.purchase_id');
                })
                ->leftJoin('gym_clients','gym_clients.id','=','gym_membership_payments.user_id')
                ->where('gym_membership_payments.detail_id','=',$this->data['user']->detail_id)
                ->whereBetween('payment_date',[$start_date,$end_date]);
            return Datatables::of($payment)
                ->edit_column('first_name',function($row){
                return $row->first_name.' '.$row->last_name;})
                ->edit_column('payment_date',function ($row){
                    return $row->payment_date->toFormattedDateString();
                })
                ->remove_column('last_name')
                ->make();
        }else{
            $payment = GymPurchase::select(
                'gym_client_purchases.id',
                'first_name',
                'last_name',
                'amount_to_be_paid',
                'paid_amount',
                'gym_client_purchases.next_payment_date as date'
            )->leftJoin('gym_clients','gym_clients.id','=','gym_client_purchases.client_id')
                ->whereBetween('next_payment_date',[$start_date,$end_date])
                ->where('payment_required','=','yes')
                ->where('gym_client_purchases.detail_id','=',$this->data['user']->detail_id);
            return Datatables::of($payment)
                ->edit_column('first_name',function($row){
                    return $row->first_name.' '.$row->last_name;})
                ->edit_column('amount_to_be_paid', function ($row) {
                    return $row->amount_to_be_paid - $row->paid_amount;
                })
                ->edit_column('date',function($row){
                    return Carbon::createFromFormat('Y-m-d',$row->date)->toFormattedDateString();})
                ->add_column('action', function ($row) {
                    return '<a  data-id="'.$row->id.'" class="show-reminder btn blue btn-xs"><i class="fa fa-send"></i> Send Reminder</a>';
                })
                ->remove_column('last_name')
                ->remove_column('id')
                ->remove_column('paid_amount')
                ->rawColumns([3])
                ->make();

        }
    }
}
