<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class GymClient extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at','joining_date','dob', 'anniversary'];
    protected $table = 'gym_clients';
    protected $guarded = ['id'];

    public static $MAX_CLIENTS = 100;

    public static function rules($action, $id=null, $businessID) {
        $rules = [
            'general' => [
                'first_name' => 'required|alpha_spaces',
                'last_name' => 'required|alpha_spaces',
                'gender' => 'required',
                'email' => 'required|email|unique:gym_clients,email,'.$id.',id,detail_id,'.$businessID,
                'dob' => 'required',
                'mobile' => 'required|unique:gym_clients,mobile,'.$id.',id,detail_id,'.$businessID,
                'age' => 'numeric',
                'marital_status' => 'required',
                'height_inches' => 'numeric',
                'height_feet' => 'numeric',
                'weight' => 'numeric',
                //'source' => 'required',
            ],
            'file' => [
                'file' => ''
            ]
        ];
        return $rules[$action];
    }

    public static function GetClients($businessId) {
        return GymClient::join('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
            ->where('business_customers.detail_id', '=', $businessId)
            ->select('gym_clients.id', 'gym_clients.first_name', 'gym_clients.last_name')
            ->get();
    }

    public static function monthlyClients($businessId, $month) {
        return GymClient::join('business_customers', 'business_customers.customer_id', '=', 'gym_clients.id')
            ->where('business_customers.detail_id', '=', $businessId)
            ->where(DB::raw('MONTH(gym_clients.created_at)'), $month)
            ->count();
    }
}
