<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GymMerchantRoleTrait;

class GymMerchantRole extends Model
{
    use GymMerchantRoleTrait;

    protected $table = 'gym_merchant_roles';

    protected $fillable = ['name', 'detail_id'];

    public static $rules = ['name' => 'required'];

    public function business() {
        return $this->belongsTo(GymMerchantRole::class, 'detail_id');
    }

    public static function byBusinessId($businessId) {
        return GymMerchantRole::where('detail_id', $businessId)->get();
    }
}
