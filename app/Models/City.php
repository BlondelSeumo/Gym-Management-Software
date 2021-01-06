<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use Sluggable, SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $table = "cities";

    public function state() {
        return $this->belongsTo(State::class,'state_id');
    }

    public function area() {
        return $this->hasMany(Area::class, 'city_id');
    }

    // Add your validation rules here
    public static $rules = ['name' => 'required|unique:cities'];

    protected $fillable = ['state_id', 'name', 'longitude', 'latitude'];
}
