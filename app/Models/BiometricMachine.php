<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiometricMachine extends Model
{
    public static $rules = [
        'detail_id' => 'required'
    ];

    public function detail() {
        return $this->belongsTo(Common::class, 'detail_id');
    }
}
