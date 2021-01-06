<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCustomer extends Model
{
    protected $table = 'business_customers';

    protected $fillable = ['detail_id', 'customer_id'];

    public function business() {
        return $this->belongsTo(Common::class, 'detail_id');
    }

    public function customer() {
        return $this->belongsTo(GymClient::class, 'customer_id');
    }

    public static function findByCustomer($id) {
        return BusinessCustomer::where('customer_id','=', $id)
            ->first();
    }
}
