<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = ['cache_status','under_development','logo','fb_url','twitter_url','google_plus_url','contact_no','address'];
}
