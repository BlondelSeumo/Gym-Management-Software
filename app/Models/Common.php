<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    use Sluggable, SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $table = "common_details";

    // Add your validation rules here
    public static $rules = [
        'title' => 'required',
        'city_id' => 'required',
        'address' => 'required',
        'area_id' => 'required',
        'owner_incharge_name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'category_id' => 'required'
    ];

    //Validation Rules for add business
    public static $businessRules = [
        'title' => 'required',
        'email' => 'required',
        'owner_incharge_name' => 'required',
        'phone' => 'required',
        'address' => 'required'
    ];

    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function area() {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public static function Detail($id) {
        return Common::where('id', '=', $id)->first();
    }

    public static function allActiveGyms() {
        return Common::where('status', '=', 'active')
            ->get();
    }

    public static function allActiveBusiness() {
        return Common::where('status', '=', 'active')
            ->orderBy('title', 'asc')
            ->listed()
            ->get();
    }

    public static function last20Listings() {
        return Common::where('status', '=', 'active')
            ->listed()
            ->orderBy('id', 'desc')
            ->take(20)
            ->get();
    }

    public function subCategory() {
        return $this->hasMany(BusinessCategory::class, 'detail_id');
    }

    public static function aceBusinesses() {
        return Common::all();
    }

    public function memberships() {
        return $this->hasMany(GymMembership::class, 'detail_id', 'id');
    }

    protected $fillable = ['city_id', 'title', 'address', 'area_id', 'latitude', 'longitude', 'email', 'phone', 'phone2', 'status', 'website', 'owner_incharge_name', 'owner_incharge_name2', 'last_updated', 'bitly_link', 'search_title'];
}
