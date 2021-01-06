<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $table = "areas";

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public static $rules = [
        'name' => 'required|unique:areas'
    ];

    public static function byCity($cityID)
    {
        return Area::where('city_id','=',$cityID)
            ->orderBy('name','ASC')->get();
    }

    protected $fillable = ['name', 'city_id', 'slug', 'latitude', 'longitude'];
}
