<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymMerchantRoleUser extends Model
{
    protected $table = 'gym_merchant_role_users';

    public $timestamps = false;

    public static $rules = ['role_id' => 'required'];

    protected $fillable = ['role_id', 'user_id', 'id'];
}
