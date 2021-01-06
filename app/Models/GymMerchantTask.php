<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymMerchantTask extends Model
{
    protected $table = 'task_management';

    public function merchant() {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    protected $fillable = ['merchant_id', 'heading', 'description', 'deadline', 'status', 'priority'];
}
