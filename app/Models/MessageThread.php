<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageThread extends Model
{
    public $timestamps = false;
    protected $table = 'message_threads';
    protected $fillable = ['customer_id', 'merchant_id', 'detail_id'];

    public function client()
    {
        return $this->belongsTo(GymClient::class, 'customer_id')->withTrashed();
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }
}
