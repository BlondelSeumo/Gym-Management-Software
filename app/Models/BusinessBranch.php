<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessBranch extends Model
{
    protected $table = "business_branches";

    // Add your validation rules here
    public static $rules = [
        'detail_id' => 'required',
        'area_id' => 'required'
    ];

    public static function businessBranches($businessId)
    {
        return BusinessBranch::where('detail_id','=',$businessId)
            ->where('status','=','active')
            ->get();
    }

    public static function businessAppointmentBranches($businessId)
    {
        return BusinessBranch::where('detail_id','=',$businessId)
            ->where('status','=','active')
            ->where('book_appointments','=','yes')
            ->get();
    }

    public function area()
    {
        return $this->belongsTo(Area::class,'area_id');
    }

    // Don't forget to fill this array
    protected $guarded = ['id'];
}
