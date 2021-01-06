<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymMerchantPermissionRole extends Model
{
    protected $table = "gym_merchant_role_permissions";

    public static function rolePermissions($roleId) {
        return GymMerchantPermissionRole::whereRole_id($roleId)->get();
    }

    protected $fillable = ['role_id', 'permission_id'];
    public $timestamps = false;
}
