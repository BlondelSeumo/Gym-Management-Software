<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    protected $table = "business_categories";

    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function memberships() {
        return $this->hasMany(GymMembership::class, 'business_category_id');
    }

    public function membershipBranch() {
        return $this->belongsTo(Common::class, 'detail_id');
    }

    public static function businessCategories($businessId) {
        return BusinessCategory::with('category', 'membershipBranch.memberships')
            ->where('detail_id', '=', $businessId)->get();
    }

    protected $fillable = ['detail_id', 'category_id'];
}
