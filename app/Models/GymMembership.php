<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GymMembership extends Model
{
    use SoftDeletes;

    protected $table = 'gym_memberships';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    public function subCategory() {
        return $this->belongsTo(BusinessCategory::class, 'business_category_id');
    }

    public static function rules($action, $subId, $id = null) {
        $rules = [
            'add' => ['title' => 'required|unique:gym_memberships,title,NULL,id,business_category_id,' . $subId, 'price' => 'required|numeric', 'duration' => 'required'],
            'edit' => ['title' => 'required|unique:gym_memberships,title,' . $id . ',id,business_category_id,' . $subId, 'price' => 'required|numeric', 'duration' => 'required']
        ];
        return $rules[$action];
    }

    public static function merchantMembershipDetail($memID, $businessID) {
        return GymMembership::where('id', '=', $memID)->where('detail_id', '=', $businessID)->first();
    }

    public static function membershipsForSelect($id) {
        return GymMembership::select('id', 'title')->where('detail_id', '=', $id)->get();
    }

    public static function membershipByBusiness($businessID) {
        return GymMembership::where('detail_id', '=', $businessID)->get();
    }

    public static function membershipByName($name, $businessID) {
        return GymMembership::where('title', $name)->where('detail_id', '=', $businessID)->first();
    }
}
