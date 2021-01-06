<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\BusinessEnquiry;
use App\Models\GymEnquiries;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;

class GymEnquiryReportController extends GymAdminBaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->data['reportMenu'] = 'active';
        $this->data['enquiryreportMenu'] = 'active';
    }
    public function index()
    {
        if(!$this->data['user']->can("view_enquiry_report"))
        {
            return App::abort(401);
        }

        $this->data['title'] = 'Enquiry Report';
        return View::make('gym-admin.reports.enquiry.index',$this->data);
    }

    public function store()
    {
        $validator  = Validator::make(Input::all(),['date_range'=>'required']);

        if($validator->fails())
        {
            return Reply::formErrors($validator);
        }else{
            $date_range = explode('-',Input::get('date_range'));

            $date_range_start = Carbon::createFromFormat('M d, Y',trim($date_range[0]));
            $date_range_end   = Carbon::createFromFormat('M d, Y',trim($date_range[1]));

            $enquiry = GymEnquiries::whereBetween(DB::raw('DATE(created_at)'),[$date_range_start->format('Y-m-d'),$date_range_end->format('Y-m-d')])
                ->where('detail_id','=',$this->data['user']->detail_id)
                ->count();
            $heading = 'Enquiries';
            $data = [
                'total'             => $enquiry,
                'start_date'        => $date_range_start->format('Y-m-d'),
                'end_date'          => $date_range_end->format('Y-m-d'),
                'report'            => $heading
            ];
            return Reply::successWithData('Reports Fetched',$data);
        }
    }

    public function ajax_create($start_date,$end_date)
    {
        $enquiry = GymEnquiries::select('customer_name','email','mobile','sex','enquiry_date','next_follow_up')
            ->whereBetween(DB::raw('DATE(created_at)'), [$start_date, $end_date])
            ->where('detail_id', '=', $this->data['user']->detail_id);

        return Datatables::of($enquiry)
            ->edit_column('next_follow_up',function($row){
                return $row->next_follow_up->format('d M, y');
            })
            ->edit_column('enquiry_date',function($row){
                return $row->enquiry_date->format('d M, y');
            })
            ->edit_column('mobile',function($row){
                return '<i class="fa fa-mobile"></i> '.$row->mobile;
            })
            ->edit_column('sex',function($row){
                if($row->sex == 'female'){
                    return '<i class="fa fa-female"></i> Female';
                }else{
                    return '<i class="fa fa-male"></i> Male';
                }
            })
            ->rawColumns([0,1,2,3,4,5,6])
            ->make();

    }
}
