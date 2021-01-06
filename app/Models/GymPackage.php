<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymPackage extends Model
{
    protected $table = 'gym_packages';

    protected $guarded = ['id'];

    public static function rules($action)
    {
        $rules = [
            'add'=>[
                'title' => 'required',
                'price' => 'required',
                'details' => 'required',
                'package_for'=>'required'
            ]
        ];
        return $rules[$action];
    }

    public function memberships()
    {
        $this->hasMany(GymPackageMembership::class,'package_id','id');
    }

    public static function businessPackages($businessID)
    {
        return GymPackage::where('detail_id','=',$businessID)->get();
    }

    public static function businessPackageDetail($businessID,$id)
    {
        return GymPackage::where('detail_id','=',$businessID)
                        ->where('id','=',$id)
                        ->first();
    }


}
