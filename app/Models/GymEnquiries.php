<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GymEnquiries extends Model
{

    public static $rules = [
        'enquiry_date' => 'required|date',
        'customer_name' => 'required',
        'mobile' => 'required',
        'email' => 'required|email',
        'dob'  => 'required|date'
    ];

    protected $dates = ['previous_follow_up', 'next_follow_up', 'dob', 'enquiry_date'];

    protected $guarded = ['id'];

    public function followUp() {
        return $this->hasMany(GymEnquiriesFollowUp::class, 'gym_enquiry_id');
    }

    public static function gymEnquiry($businessId, $id) {
        return GymEnquiries::with('followUp')
            ->where('detail_id', $businessId)->find($id);
    }

    public static function monthlyEnquiries($businessId, $month) {
        return GymEnquiries::where('detail_id', $businessId)
            ->where(DB::raw('MONTH(enquiry_date)'), $month)
            ->count();
    }

}
