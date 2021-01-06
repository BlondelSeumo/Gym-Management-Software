<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
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

    protected $table = "categories";

    // Add your validation rules here
    public static $rules = [
        'name' => 'required'
    ];

    public function scopeActive($query) {
        return $query->where('categories.status', 'active');
    }

    // Don't forget to fill this array
    protected $fillable = ["name", "status", 'slug'];
}
