<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoftwareUpdate extends Model
{
    protected $table = 'software_updates';

    protected $dates = ['date'];

    // Add your validation rules here
    public static $rules = [
        'title' => 'required',
        'detail' => 'required',
        'date' => 'required',
    ];

    public static function GetUpcomingInfo() {
        return SoftwareUpdate::select('title', 'details', 'date')
            ->orderBy('date', 'desc')
            ->get();
    }
}
