<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\GymPurchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;

class GymBookingReportsController extends GymAdminBaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->data['reportMenu'] = 'active';
        $this->data['bookingreportMenu'] = 'active';
    }
    public function index()
    {
        if(!$this->data['user']->can("view_booking_report"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Booking Report';
        return View::make('gym-admin.reports.booking.index',$this->data);
    }

    public function store()
    {
        $validator  = Validator::make(Input::all(),['booking_type'=>'required','date_range'=>'required']);

        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }else{
            $choice = Input::get('booking_type');
            $date_range = explode('-',Input::get('date_range'));

            $date_range_start = Carbon::createFromFormat('M d, Y',trim($date_range[0]));
            $date_range_end   = Carbon::createFromFormat('M d, Y',trim($date_range[1]));
            $sum = 0;
            $heading = '';

            switch($choice){
                case 'membership':
                    $sum = GymPurchase::whereBetween('purchase_date',[$date_range_start->format('Y-m-d'),$date_range_end->format('Y-m-d')])
                        ->where('detail_id','=',$this->data['user']->detail_id)
                        ->whereNotNull('membership_id')->count();
                    $heading = 'Memberships';
                    break;
                case 'offer':
                    $sum = GymPurchase::whereBetween('purchase_date',[$date_range_start->format('Y-m-d'),$date_range_end->format('Y-m-d')])
                        ->where('detail_id','=',$this->data['user']->detail_id)
                        ->whereNotNull('offer_id')->count();
                    $heading = 'Offers';
                    break;
                case 'all':
                    $sum = GymPurchase::whereBetween('purchase_date',[$date_range_start->format('Y-m-d'),$date_range_end->format('Y-m-d')])
                        ->where('detail_id','=',$this->data['user']->detail_id)
                        ->count();
                    $heading = 'All';
                    break;
            }

            $data = [
                'total'             => $sum,
                'start_date'        => $date_range_start->format('Y-m-d'),
                'end_date'          => $date_range_end->format('Y-m-d'),
                'type'              => $choice,
                'report'            => $heading
            ];

            return Reply::successWithData('Reports Fetched',$data);
        }
    }

    public function ajax_create($type,$start_date,$end_date)
    {

        switch($type){
            case 'membership':
                $booking = GymPurchase::select(
                            'gym_clients.first_name',
                            'gym_clients.last_name',
                            'amount_to_be_paid',
                            'gym_memberships.title as membership',
                            'gym_client_purchases.start_date')
                    ->leftJoin('gym_clients','gym_clients.id','=','gym_client_purchases.client_id')
                    ->leftJoin('gym_memberships','gym_memberships.id','=','gym_client_purchases.membership_id')
                    ->whereBetween('purchase_date',[$start_date,$end_date])
                    ->where('gym_client_purchases.detail_id','=',$this->data['user']->detail_id)
                    ->whereNotNull('gym_client_purchases.membership_id');

                break;
            case 'all':
                $booking = GymPurchase::select(
                    'gym_clients.first_name',
                    'gym_clients.last_name',
                    'amount_to_be_paid',
                    'gym_memberships.title as membership',
                    'gym_client_purchases.start_date')
                    ->leftJoin('gym_clients','gym_clients.id','=','gym_client_purchases.client_id')
                    ->leftJoin('gym_memberships','gym_memberships.id','=','gym_client_purchases.membership_id')
                    ->whereBetween('purchase_date',[$start_date,$end_date])
                    ->where('gym_client_purchases.detail_id','=',$this->data['user']->detail_id);
                break;
        }
        return Datatables::of($booking)
            ->edit_column('first_name',function($row){
                return $row->first_name.' '.$row->last_name;
            })->add_column('name',function($row) {
                return $row->membership;
            })->edit_column('start_date',function($row){
                return $row->start_date->toFormattedDateString();
            })
            ->remove_column('last_name')
            ->remove_column('membership')
            ->make();
    }
}
