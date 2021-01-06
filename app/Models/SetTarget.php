<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetTarget extends Model
{
    protected $table = 'set_targets';

    public static function allTargetCount($businessId) {
        return SetTarget::where('detail_id', '=', $businessId)->get()->count();
    }

    public static function allBusinessTargets($businessId) {
        return SetTarget::where('detail_id', '=', $businessId)->get();
    }

    public function targetType() {
        return $this->hasOne(TargetType::class, 'id', 'target_type');
    }

}
