<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Paginator;

class GymClientAttendance extends Model
{
    protected $table = "gym_client_attendances";

    protected $dates = ['check_in'];

    protected $guarded = ['id'];

    public static function reportRules($action) {
        $rules = [
            'defaulter' => [
                'days' => 'required',
                'date_range' => 'required'
            ]  ,
            'attendance' => [
                'date_range' => 'required',
                'cat' => 'required',
            ]
        ];
        return $rules[$action];
    }

    public static function attendanceByDate($date,$search) {
        return GymClient::select(
            'gym_clients.id',
            'gym_clients.first_name',
            'gym_clients.last_name',
            'gym_clients.joining_date',
            'gym_client_attendances.check_in',
            'gym_client_attendances.status',
            'gym_clients.image',
            'gym_client_attendances.id as checkin_id',
            DB::raw('(select count(`gym_clients.id`) from gym_client_attendances where gym_clients.id=gym_client_attendances.client_id) as total_checkin')
        )
            ->leftJoin(
                'gym_client_attendances',
                function ($join) use ($date) {
                    $join->on('gym_clients.id', '=', 'gym_client_attendances.client_id')
                        ->where(DB::raw('DATE(gym_client_attendances.check_in)'), '=', $date);
                }
            )
            ->where(
                function($query) use ($search){
                    if($search != ''){
                        $query->where('gym_clients.first_name', 'LIKE', '%'.$search.'%');
                        $query->orWhere('gym_clients.last_name', 'LIKE', '%'.$search.'%');
                    }
                }
            )

            ->get();
    }

    public static function clientAttendanceByDate($date,$search,$businessID) {
        return GymClient::leftJoin(
            'gym_client_attendances', function ($join) use ($date) {
            $join->on('gym_clients.id', '=', 'gym_client_attendances.client_id')
                ->where(DB::raw('DATE(gym_client_attendances.check_in)'), '=', $date);
        }
        )
            ->leftJoin('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
            ->select(
                'gym_clients.id',
                'gym_clients.first_name',
                'gym_clients.last_name',
                'gym_clients.joining_date',
                'gym_client_attendances.check_in',
                'gym_client_attendances.status',
                'gym_clients.image',
                'gym_client_attendances.id as checkin_id',
                DB::raw('(select count(`id`) from gym_client_attendances where gym_clients.id=gym_client_attendances.client_id) as total_checkin')
            )

            ->where(
                function($query) use ($search){
                    if($search != ''){
                        $query->where('gym_clients.first_name', 'LIKE', '%'.$search.'%');
                        $query->orWhere('gym_clients.last_name', 'LIKE', '%'.$search.'%');
                    }
                }
            )
            ->where('business_customers.detail_id', '=', $businessID)
            ->whereNotNull('gym_clients.joining_date')
            ->orderBy('gym_clients.first_name', 'asc');
    }

    public static function attendanceByDateCount($date, $businessID) {
        return GymClientAttendance::join('gym_clients', 'gym_clients.id', '=', 'gym_client_attendances.client_id')
            ->leftJoin('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
            ->where(DB::raw("DATE(gym_client_attendances.check_in)"), $date)
            ->where('business_customers.detail_id', $businessID)
            ->count();
    }

    public static function markAttendance($clientId, $date) {
        return GymClientAttendance::firstOrCreate(['client_id' => $clientId, 'check_in' => $date]);
    }

}
