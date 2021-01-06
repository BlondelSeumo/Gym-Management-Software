<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    protected $table = "states";

    public function state() {
        return $this->hasMany(City::class, 'state_id');
    }

    protected $fillable = ['country_id', 'name', 'state_code'];
}
