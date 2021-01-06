<?php namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission{
	protected $fillable = ['name','display_name'];

	public static $rules = [
		'display_name'=>'required',
		'name'=>'required'
	];
}