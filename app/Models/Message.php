<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = ['customer_id', 'merchant_id', 'to', 'from', 'text'];
}
