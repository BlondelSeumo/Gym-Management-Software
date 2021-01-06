<?php namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {


	protected $fillable = ['name'];
	public static $rules = [
		'name'=>'required'
	];
}