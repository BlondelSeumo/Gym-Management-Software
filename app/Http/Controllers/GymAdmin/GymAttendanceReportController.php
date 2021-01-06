<?php

namespace App\Http\Controllers\GymAdmin;

use App\Classes\Reply;
use App\Models\BusinessCategory;
use App\Models\GymClient;
use App\Models\GymClientAttendance;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;

class GymAttendanceReportController extends GymAdminBaseController
{

    public function __construct() {
        parent::__construct();

        $this->data['reportMenu'] = 'active';
        $this->data['attendancereportMenu'] = 'active';
    }

    public function index() {
        if(!$this->data['user']->can("view_attendance_report"))
        {
            return App::abort(401);
        }
        $this->data['title'] = "Attendance Report";
        $this->data['subcategories'] = BusinessCategory::businessCategories($this->data['user']->detail_id);
        return View::make('gym-admin.reports.attendance.index', $this->data);
    }

    public function store() {

        $type = Input::get('type');
        $validator = Validator::make(Input::all(), GymClientAttendance::reportRules($type));

        if ($validator->fails()) {
            return Reply::formErrors($validator);
        }
        else {

            if ($type == 'defaulter') {
                $days = Input::get('days');
                $date_range = explode('-', Input::get('date_range'));

                $date_range_start = Carbon::createFromFormat('M d, Y', trim($date_range[0]));
                $date_range_end = Carbon::createFromFormat('M d, Y', trim($date_range[1]));
                $days_diff = $date_range_end->diffInDays($date_range_start);
                $detail_id = $this->data['user']->detail_id;
                $filter = $days_diff - $days;

                $total = 0;

                $defaulters = DB::select('select table1.* from
                        (select `gym_clients`.`id`,COUNT(gym_client_attendances.client_id) as attendance,first_name,last_name,email,mobile,gender
                        from `gym_clients` 
                        left join `gym_client_attendances` 
                        on `gym_client_attendances`.`client_id` = `gym_clients`.`id`
                        left join `business_customers` 
                        on `business_customers`.`customer_id` = `gym_clients`.`id` 
                        where `business_customers`.`detail_id` = \'' . $detail_id . '\'
                        and `gym_clients`.`deleted_at` is null
                        GROUP BY gym_clients.id ) table1 
                        LEFT JOIN
                        (select `gym_clients`.`id`,COUNT(gym_client_attendances.client_id) as kirti
                        from `gym_clients` 
                        left join `gym_client_attendances` 
                        on `gym_client_attendances`.`client_id` = `gym_clients`.`id`
                        left join `business_customers` 
                        on `business_customers`.`customer_id` = `gym_clients`.`id` 
                        where `business_customers`.`detail_id` = \'' . $detail_id . '\'
                         and `check_in` between \'' . $date_range_start->format('Y-m-d') . '\' and \'' . $date_range_end->format('Y-m-d') . '\'
                        and `gym_clients`.`deleted_at` is null
                        GROUP BY gym_clients.id ) table2 
                        on table1.id = table2.id
                        WHERE table1.attendance < ' . $filter);

                $total = count($defaulters);
                $data = [
                    'total'             => $total,
                    'start_date'        => $date_range_start->format('Y-m-d'),
                    'end_date'          => $date_range_end->format('Y-m-d'),
                    'days'              => $days,
                    'type'              => $type,
                    'report'            => 'Attendance Defaulters'
                ];

                return Reply::successWithData('Reports Fetched', $data);
            }
            if ($type == 'attendance') {
                $date_range = explode('-', Input::get('date_range'));

                $date_start = Carbon::createFromFormat('M d, Y', trim($date_range[0]));
                $date_end = Carbon::createFromFormat('M d, Y', trim($date_range[1]));
                if (Input::get('start_time') != '') {
                    $start_time = Carbon::createFromFormat('H:i a', Input::get('start_time'))->format('H:i:s');
                }
                else {
                    $start_time = '00:00:00';
                }
                if (Input::get('end_time') != '') {
                    $end_time = Carbon::createFromFormat('H:i a', Input::get('end_time'))->format('H:i:s');
                }
                else {
                    $end_time = '23:59:59';
                }


                $cat_id = Input::get('cat');


              $clients=  Category::leftJoin('business_categories','business_categories.category_id','=','categories.id')
                    ->leftJoin('gym_memberships','gym_memberships.business_category_id','=','business_categories.id')
                    ->leftJoin('gym_client_purchases','gym_client_purchases.membership_id','=','gym_memberships.id')
                    ->leftJoin('gym_clients','gym_clients.id','=','gym_client_purchases.client_id')
                    ->leftJoin('gym_client_attendances','gym_client_attendances.client_id','=','gym_clients.id')
                    ->leftJoin('business_customers', 'business_customers.customer_id','=', 'gym_clients.id')
                    ->whereDate('check_in','>=',$date_start->format('Y-m-d'))
                    ->whereDate('check_in','<=',$date_end->format('Y-m-d'))

                    ->where(function($query) use ($start_time, $end_time)
                    {
                        if($start_time != '00:00:00' && $end_time != '00:00:00')
                        {
                            $query->whereRaw('Time(check_in) BETWEEN "'.$start_time.'" and "'.$end_time.'"');
//                            $query->whereRaw('Time(check_in)','>=',$start_time->format('H:i:s'));
//                            $query->whereRaw('Time(check_in)','<=',$end_time->format('H:i:s'));
                        }

                    })
                    //->whereRaw('Time(check_in) BETWEEN "'.$start_time.'" and "'.$end_time.'"')
                    ->where('categories.id','=',$cat_id)
                  ->where('business_customers.detail_id','=',$this->data['user']->detail_id)
                  ->count();

                $data = [
                    'total'             => $clients,
                    'start_date'        => $date_start->format('Y-m-d'),
                    'end_date'          => $date_end->format('Y-m-d'),
                    'start_time'        => $start_time,
                    'end_time'          => $end_time,
                    'cat'              => $cat_id,
                    'report'            => 'Attendance'
                ];
                return Reply::successWithData('Reports Fetched',$data);
            }

        }
    }

    public function ajax_create($days, $start_date, $end_date) {


        $start_date = Carbon::createFromFormat('Y-m-d', $start_date);
        $end_date = Carbon::createFromFormat('Y-m-d', $end_date);
        $days_diff = $end_date->diffInDays($start_date);
        $detail_id = $this->data['user']->detail_id;

        $filter = $days_diff - $days;


        $defaulters = DB::select('select table1.* from  
                        (select first_name,last_name,email,mobile,gender,`gym_clients`.`id`,COUNT(gym_client_attendances.client_id) as attendance
                        from `gym_clients` 
                        left join `gym_client_attendances` 
                        on `gym_client_attendances`.`client_id` = `gym_clients`.`id` 
                        left join `business_customers` 
                        on `business_customers`.`customer_id` = `gym_clients`.`id`
                        where `business_customers`.`detail_id` = \'' . $detail_id . '\'
                        and `gym_clients`.`deleted_at` is null
                        GROUP BY gym_clients.id ) table1 
                        LEFT JOIN
                        (select `gym_clients`.`id`,COUNT(gym_client_attendances.client_id) as kirti
                        from `gym_clients` 
                        left join `gym_client_attendances` 
                        on `gym_client_attendances`.`client_id` = `gym_clients`.`id`
                        left join `business_customers` 
                        on `business_customers`.`customer_id` = `gym_clients`.`id` 
                        where `business_customers`.`detail_id` = \'' . $detail_id . '\'
                         and `check_in` between \'' . $start_date->format('Y-m-d') . '\' and \'' . $end_date->format('Y-m-d') . '\'
                        and `gym_clients`.`deleted_at` is null
                        GROUP BY gym_clients.id ) table2 
                        on table1.id = table2.id
                        WHERE table1.attendance < ' . $filter);

        $de = collect($defaulters);


        return Datatables::of($de)
            ->edit_column('first_name',function($row){
                return $row->first_name.' '.$row->last_name;
            })
            ->edit_column('email',function($row){
                return '<i class="fa fa-envelope"></i> '.$row->email;
            })->edit_column('mobile',function($row){
                return '<i class="fa fa-mobile"></i> '.$row->mobile;
            })->edit_column('gender',function($row){
                if($row->gender == 'female'){
                    return '<i class="fa fa-female"></i> Female';
                }else{
                    return '<i class="fa fa-male"></i> Male';
                }
            })->add_column('action',function($row){
                return '<a href="'.route('gym-admin.client.calender',$row->id).'" class="btn blue"> <i class="fa fa-calendar"></i> Attendance</a>';
            })
            ->remove_column('last_name')
            ->remove_column('id')
            ->remove_column('attendance')
            ->rawColumns([1,2,3,4,5])
            ->make();
    }

    public function ajax_create_attendance($cat_id,$start_date,$end_date,$start_time,$end_time)
    {
        $clients=  Category::select('first_name','last_name','email','mobile','gender','check_in')
            ->leftJoin('business_categories','business_categories.category_id','=','categories.id')
            ->leftJoin('gym_memberships','gym_memberships.business_category_id','=','business_categories.id')
            ->leftJoin('gym_client_purchases','gym_client_purchases.membership_id','=','gym_memberships.id')
            ->leftJoin('gym_clients','gym_clients.id','=','gym_client_purchases.client_id')
            ->leftJoin('gym_client_attendances','gym_client_attendances.client_id','=','gym_clients.id')
            ->leftJoin('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
            ->whereDate('check_in','>=',$start_date)
            ->whereDate('check_in','<=',$end_date)
            ->where(function($query) use ($start_time, $end_time)
            {
                if($start_time != '00:00:00' && $end_time != '00:00:00')
                {
                    $query->whereRaw('Time(check_in) BETWEEN "'.$start_time.'" and "'.$end_time.'"');
                }

            })

            //->whereRaw('Time(check_in) BETWEEN "'.$start_time.'" and "'.$end_time.'"')
            ->where('categories.id','=',$cat_id)
            ->where('business_customers.detail_id','=',$this->data['user']->detail_id);
        
        return Datatables::of($clients)
            ->edit_column('first_name',function($row){
                return $row->first_name.' '.$row->last_name;
            })
            ->edit_column('email',function($row){
                return '<i class="fa fa-envelope"></i> '.$row->email;
            })->edit_column('mobile',function($row){
                return '<i class="fa fa-mobile"></i> '.$row->mobile;
            })->edit_column('gender',function($row){
                if($row->gender == 'female'){
                    return '<i class="fa fa-female"></i> Female';
                }else{
                    return '<i class="fa fa-male"></i> Male';
                }
            })->edit_column('check_in',function($row){
                return Carbon::createFromFormat('Y-m-d H:i:s',$row->check_in)->toDayDateTimeString();
            })
            ->remove_column('last_name')
            ->rawColumns([0,1,2,3,4,5])
            ->make();
    }
}
