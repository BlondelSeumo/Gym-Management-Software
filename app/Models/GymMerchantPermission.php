<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GymMerchantPermissionTrait;

class GymMerchantPermission extends Model
{
    use GymMerchantPermissionTrait;

    protected $table = 'gym_merchant_permissions';

    protected $fillable = ['name', 'display_name', 'for'];

    public static $rules = ['display_name' => 'required', 'name' => 'required'];
}
