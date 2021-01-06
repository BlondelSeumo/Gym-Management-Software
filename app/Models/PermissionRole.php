<?php namespace App\Models;

class PermissionRole extends \Eloquent {

	protected $table = "permission_role";


	public static function rolePermissions($roleId)
	{
		return PermissionRole::whereRole_id($roleId)->get();
	}

}