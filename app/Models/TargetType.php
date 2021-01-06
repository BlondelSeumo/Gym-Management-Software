<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetType extends Model
{
    protected $table = 'target_type';

    public static function targetType($business_id)
    {
        $category = BusinessCategory::select('category_id')->where('detail_id','=',$business_id)->get()->toArray();

        return TargetType::whereIn('category_id', $category)->get();
    }
}
