<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AceFeatures extends Model
{

    public static function fitnessFeatures($categoryId) {
        return AceFeatures::where('category_id', $categoryId)->get();
    }

}
