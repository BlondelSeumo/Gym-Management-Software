<?php namespace App\Models;

class Pic extends \Eloquent {

    protected $table = "pics";

    public function facilities()
    {
        return $this->belongsTo(Common::class,'detail_id');
    }

    /*query functions*/
    public static function businessPics($Id)
    {
        return Pic::where('detail_id', '=', $Id)
            ->orderBy('main_image', 'asc')
            ->get();
    }

    public static function businessPicsCount($businessID)
    {
        return Pic::where('detail_id','=',$businessID)
            ->count();
    }

    public static function businessMainPic($businessID)
    {
        return Pic::where('detail_id','=',$businessID)
            ->where('main_image','=','true')
            ->first();
    }

    protected $fillable = ['detail_id','image','main_image'];
}