<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcePlans extends Model
{
    public static function fitnessPlans($categoryId) {
        return AcePlans::where('category_id', $categoryId)->get();
    }
}
